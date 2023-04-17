import axios from 'axios';
import { authHeader } from '../helpers';
import { userService } from '../services';

async function getMultipleLast(equipments) {
    return axios
        .post(
            `${process.env.REACT_APP_API_URL}/meeting_point_status/read_multiple_last.php`,
            { equipments },
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

export const meetingPointStatusService = { getMultipleLast };
