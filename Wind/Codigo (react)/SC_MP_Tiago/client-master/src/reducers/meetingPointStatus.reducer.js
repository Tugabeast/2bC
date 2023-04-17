import { meetingPointStatusConstants } from '../constants';

const initialState = { loading: true, items: [] };

export function meetingPointStatus(state = initialState, action) {
    switch (action.type) {
        case meetingPointStatusConstants.GET_REQUEST:
            return { ...state, loading: true };

        case meetingPointStatusConstants.GET_SUCCESS:
            return {
                loading: false,
                items: action.meetingPointStatus,
            };

        case meetingPointStatusConstants.GET_FAILURE:
            return { ...state, loading: false, error: action.error };

        default:
            return state;
    }
}
