import { meetingPointService } from '../services';
import { meetingPointConstants } from '../constants';
import { alertActions } from '../actions';

function create(meetingPoint) {
    return (dispatch) => {
        dispatch(request());

        meetingPointService.create(meetingPoint).then(
            (createdMeetingPoint) => {
                dispatch(success(createdMeetingPoint));
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: meetingPointConstants.CREATE_REQUEST };
    }

    function success(meetingPoint) {
        return {
            type: meetingPointConstants.CREATE_SUCCESS,
            meetingPoint,
        };
    }

    function failure(error) {
        return { type: meetingPointConstants.CREATE_FAILURE, error };
    }
}

function getAll() {
    return (dispatch) => {
        dispatch(request());

        meetingPointService.getAll().then(
            (meetingPoint) => {
                dispatch(success(meetingPoint));
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: meetingPointConstants.GET_ALL_REQUEST };
    }

    function success(meetingPoint) {
        return {
            type: meetingPointConstants.GET_ALL_SUCCESS,
            meetingPoint,
        };
    }

    function failure(error) {
        return { type: meetingPointConstants.GET_ALL_FAILURE, error };
    }
}

function update(changedMeetingPoint) {
    return (dispatch) => {
        dispatch(request());

        meetingPointService.update(changedMeetingPoint).then(
            (meetingPoint) => {
                dispatch(success(meetingPoint));
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: meetingPointConstants.UPDATE_REQUEST };
    }

    function success(meetingPoint) {
        return {
            type: meetingPointConstants.UPDATE_SUCCESS,
            meetingPoint,
        };
    }

    function failure(error) {
        return { type: meetingPointConstants.UPDATE_FAILURE, error };
    }
}

function destroy(meetingPointId) {
    return (dispatch) => {
        dispatch(request());

        meetingPointService.erase(meetingPointId).then(
            () => {
                dispatch(success());
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: meetingPointConstants.DELETE_REQUEST };
    }

    function success() {
        return {
            type: meetingPointConstants.DELETE_SUCCESS,
        };
    }

    function failure(error) {
        return { type: meetingPointConstants.DELETE_FAILURE, error };
    }
}

export const meetingPointActions = { create, getAll, update, destroy };
