import { userConstants } from '../constants';

export function users(state = { loading: true }, action) {
    switch (action.type) {
        case userConstants.CREATE_REQUEST:
            return { ...state, loading: true };

        case userConstants.CREATE_SUCCESS:
            return { ...state, loading: false, message: action.res.message };

        case userConstants.CREATE_FAILURE:
            return { ...state, loading: false, error: action.error };

        case userConstants.GET_ALL_REQUEST:
            return { ...state, loading: true };

        case userConstants.GET_ALL_SUCCESS:
            return { ...state, loading: false, items: action.users.users };

        case userConstants.GET_ALL_FAILURE:
            return { ...state, loading: false, error: action.error };

        case userConstants.UPDATE_REQUEST:
            return { ...state, loading: true };

        case userConstants.UPDATE_SUCCESS:
            return { ...state, loading: false, message: action.res.message };

        case userConstants.UPDATE_FAILURE:
            return { ...state, loading: false, error: action.error };

        case userConstants.DELETE_REQUEST:
            return { ...state, loading: true };

        case userConstants.DELETE_SUCCESS:
            return { ...state, loading: false, message: action.res.message };

        case userConstants.DELETE_FAILURE:
            return { ...state, loading: false, error: action.error };

        default:
            return state;
    }
}
