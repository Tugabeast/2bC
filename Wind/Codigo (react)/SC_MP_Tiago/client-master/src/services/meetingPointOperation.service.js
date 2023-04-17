import axios from 'axios';
import { authHeader } from '../helpers';
import { userService } from './user.service';

async function create(equipmentId, operation, userName) {
    return axios
        .post(
            `${process.env.REACT_APP_API_URL}/meeting_point_operation/create.php`,
            {
                equipmentId,
                operation,
                userName,
            },
            {
                headers: authHeader(),
            },
        )
        .then((res) => res.data)
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

export const meetingPointOperationService = { create };
