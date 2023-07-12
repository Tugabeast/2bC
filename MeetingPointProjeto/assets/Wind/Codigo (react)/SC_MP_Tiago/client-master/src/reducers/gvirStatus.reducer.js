import { gvirStatusConstants } from '../constants';

const initialState = { loading: true, items: {}, message: undefined };

export function gvirStatus(state = initialState, action) {
    switch (action.type) {
        case gvirStatusConstants.GET_REQUEST:
            return {
                ...state,
                loading: true,
            };

        case gvirStatusConstants.GET_SUCCESS:
            return {
                ...state,
                loading: false,
                items: action.gvir.sensorStatus,
                message: action.message,
            };

        case gvirStatusConstants.GET_FAILURE:
            return {
                ...state,
                loading: false,
                error: action.message,
            };

        case gvirStatusConstants.RELOAD_REQUEST:
            return {
                ...state,
            };

        case gvirStatusConstants.RELOAD_SUCCESS:
            return {
                ...state,
                items: action.gvir.sensorStatus,
                message: action.message,
            };

        case gvirStatusConstants.RELOAD_FAILURE:
            return {
                ...state,
                error: action.message,
            };

        default:
            return state;
    }
}
