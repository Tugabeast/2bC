import { windService } from '../services';
import { alertActions } from './alert.action';
import { windConstants } from '../constants';

function get() {
    return (dispatch) => {
        dispatch(request());

        windService.get().then(
            (wind) => {
                dispatch(success(wind));
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: windConstants.GET_REQUEST };
    }

    function success(wind) {
        return {
            type: windConstants.GET_SUCCESS,
            wind,
        };
    }

    function failure(error) {
        return { type: windConstants.GET_FAILURE, error };
    }
}

function reload() {
    return (dispatch) => {
        dispatch(request());

        windService.get().then(
            (wind) => {
                dispatch(success(wind));
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: windConstants.RELOAD_REQUEST };
    }

    function success(wind) {
        return {
            type: windConstants.RELOAD_SUCCESS,
            wind,
        };
    }

    function failure(error) {
        return { type: windConstants.RELOAD_FAILURE, error };
    }
}

export const windActions = { get, reload };
