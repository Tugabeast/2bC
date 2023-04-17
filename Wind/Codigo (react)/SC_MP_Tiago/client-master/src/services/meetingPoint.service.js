import axios from 'axios';
import { authHeader } from '../helpers';
import { userService } from '../services';

function create(newMeetingPoint) {
    return axios
        .post(
            `${process.env.REACT_APP_API_URL}/meeting_points/create.php`,
            newMeetingPoint,
        )
        .then((res) => {
            return res.data;
        })
        .catch((error) => {
            const errorMessage = error.response.data.message;

            if (error.response.status === 401) {
                userService.logout();
                window.location.reload();

                return;
            }

            return Promise.reject(errorMessage);
        });
}

async function getAll() {
    return axios
        .get(`${process.env.REACT_APP_API_URL}/meeting_points/read.php`, {
            headers: authHeader(),
        })
        .then((res) => {
            return res.data;
        })
        .catch((error) => {
            const errorMessage = error.response.data.message;

            if (error.response.status === 401) {
                userService.logout();
                window.location.reload();
                return;
            }

            return Promise.reject(errorMessage);
        });
}

function update(changedMeetingPoint) {
    return axios
        .post(
            `${process.env.REACT_APP_API_URL}/meeting_points/update.php`,
            changedMeetingPoint,
            {
                headers: authHeader(),
            },
        )
        .then((res) => {
            return res.data;
        })
        .catch((error) => {
            const errorMessage = error.response.data.message;

            if (error.response.status === 401) {
                userService.logout();
                window.location.reload();

                return;
            }

            return Promise.reject(errorMessage);
        });
}

function erase(id) {
    return axios
        .post(`${process.env.REACT_APP_API_URL}/meeting_points/delete.php`, {
            id,
        })
        .then((res) => {
            return res.data;
        })
        .catch((error) => {
            const errorMessage = error.response.data.message;

            if (error.response.status === 401) {
                userService.logout();
                window.location.reload();

                return;
            }

            return Promise.reject(errorMessage);
        });
}

export const meetingPointService = { create, getAll, update, erase };
