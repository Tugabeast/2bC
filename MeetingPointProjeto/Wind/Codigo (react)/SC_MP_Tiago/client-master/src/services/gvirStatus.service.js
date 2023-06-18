import axios from 'axios';
import { authHeader } from '../helpers';
import { userService } from './user.service';

async function get() {
    return axios
        .get(`${process.env.REACT_APP_API_URL}/gvir_status/read_last.php`, {
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

export const gvirStatusService = { get };
