import { meetingPointOperationService } from '../services';
import { meetingPointOperationConstants } from '../constants';
import { alertActions } from './alert.action';

function create(equipmentId, operation, userName) {
    return (dispatch) => {
        dispatch(request(equipmentId, operation, userName));

        meetingPointOperationService
            .create(equipmentId, operation, userName)
            .then((message) => {
                dispatch(success(message));
            })
            .catch((error) => {
                dispatch(failure(error));
                alertActions.error(error);
            });
    };

    function request(equipmentId, operation, userName) {
        return {
            type: meetingPointOperationConstants.CREATE_REQUEST,
            equipmentId,
            operation,
            userName,
        };
    }

    function success(message) {
        return { type: meetingPointOperationConstants.CREATE_SUCCESS, message };
    }

    function failure(error) {
        return { type: meetingPointOperationConstants.CREATE_FAILURE, error };
    }
}

export const meetingPointOperationActions = { create };
