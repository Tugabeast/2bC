import { gvirStatusService } from '../services';
import { alertActions } from './alert.action';
import { gvirStatusConstants } from '../constants';

function get() {
    return (dispatch) => {
        dispatch(request());

        gvirStatusService.get().then(
            (gvir) => {
                dispatch(success(gvir));
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: gvirStatusConstants.GET_REQUEST };
    }

    function success(gvir) {
        return {
            type: gvirStatusConstants.GET_SUCCESS,
            gvir,
        };
    }

    function failure(error) {
        return { type: gvirStatusConstants.GET_FAILURE, error };
    }
}

function reload() {
    return (dispatch) => {
        dispatch(request());

        gvirStatusService.get().then(
            (gvir) => {
                dispatch(success(gvir));
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: gvirStatusConstants.RELOAD_REQUEST };
    }

    function success(gvir) {
        return {
            type: gvirStatusConstants.RELOAD_SUCCESS,
            gvir,
        };
    }

    function failure(error) {
        return { type: gvirStatusConstants.RELOAD_FAILURE, error };
    }
}

export const gvirStatusActions = { get, reload };
