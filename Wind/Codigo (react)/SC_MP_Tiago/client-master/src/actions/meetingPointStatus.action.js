import { meetingPointStatusService } from '../services';
import { meetingPointStatusConstants } from '../constants';
import { alertActions } from '../actions';
import { meetingPointStatus } from '../reducers/meetingPointStatus.reducer';

/**
 *
 * @param {IDs[]} equipmentId
 * @returns {(function(*): void)|*}
 */
function getMultiple(equipmentId) {
    return (dispatch) => {
        dispatch(request());

        meetingPointStatusService.getMultipleLast(equipmentId).then(
            (meetingPointStatus) => {
                dispatch(success(meetingPointStatus));
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: meetingPointStatusConstants.GET_REQUEST };
    }

    function success(meetingPointStatus) {
        return {
            type: meetingPointStatusConstants.GET_SUCCESS,
            meetingPointStatus,
        };
    }

    function failure(error) {
        return { type: meetingPointStatusConstants.GET_FAILURE, error };
    }
}

export const meetingPointStatusActions = { getMultiple };
