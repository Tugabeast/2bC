import { meetingPointStatusConstants } from '../constants/meetingPointStatus.constants';

export function meetingPointOperation(state = {}, action) {
    switch (action.type) {
        case meetingPointStatusConstants.CREATE_REQUEST:
            return { loading: true };

        case meetingPointStatusConstants.CREATE_SUCCESS:
            return {
                message: action.message,
            };

        case meetingPointStatusConstants.CREATE_FAILURE:
            return {
                error: action.error,
            };

        default:
            return state;
    }
}
