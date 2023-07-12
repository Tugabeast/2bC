import { meetingPointConstants } from '../constants';

export function meetingPoint(state = { loading: true }, action) {
    switch (action.type) {
        case meetingPointConstants.CREATE_REQUEST:
            return {
                ...state,
                loading: true,
            };

        case meetingPointConstants.CREATE_SUCCESS:
            return {
                ...state,
                loading: false,
                message: action.meetingPoint.message,
            };

        case meetingPointConstants.CREATE_FAILURE:
            return {
                ...state,
                loading: false,
                error: action.error,
            };

        case meetingPointConstants.GET_ALL_REQUEST:
            return {
                ...state,
                loading: true,
            };

        case meetingPointConstants.GET_ALL_SUCCESS:
            return {
                ...state,
                loading: false,
                items: action.meetingPoint,
            };

        case meetingPointConstants.GET_ALL_FAILURE:
            return {
                ...state,
                loading: false,
                error: action.message,
            };

        case meetingPointConstants.UPDATE_REQUEST:
            return {
                ...state,
                loading: true,
            };

        case meetingPointConstants.UPDATE_SUCCESS:
            return {
                ...state,
                loading: false,
                message: action.meetingPoint.message,
            };

        case meetingPointConstants.UPDATE_FAILURE:
            return {
                ...state,
                loading: false,
                error: action.error.message,
            };

        case meetingPointConstants.DELETE_REQUEST:
            return {
                ...state,
                loading: true,
            };

        case meetingPointConstants.DELETE_SUCCESS:
            return {
                ...state,
                loading: false,
            };

        case meetingPointConstants.DELETE_FAILURE:
            return {
                ...state,
                loading: false,
                error: action.error.message,
            };

        default:
            return state;
    }
}
