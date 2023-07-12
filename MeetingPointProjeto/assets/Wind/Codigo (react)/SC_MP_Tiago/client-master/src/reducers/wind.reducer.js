import { windConstants } from '../constants';

const initialState = { loading: true, items: {}, message: undefined };

export function wind(state = initialState, action) {
    switch (action.type) {
        case windConstants.GET_REQUEST:
            return {
                ...state,
                loading: true,
            };

        case windConstants.GET_SUCCESS:
            return {
                ...state,
                loading: false,
                items: action.wind,
                message: action.message,
            };

        case windConstants.GET_FAILURE:
            return {
                ...state,
                loading: false,
                error: action.message,
            };

        case windConstants.RELOAD_REQUEST:
            return {
                ...state,
            };

        case windConstants.RELOAD_SUCCESS:
            return {
                ...state,
                items: action.wind,
                message: action.message,
            };

        case windConstants.RELOAD_FAILURE:
            return {
                ...state,
                error: action.message,
            };

        default:
            return state;
    }
}
