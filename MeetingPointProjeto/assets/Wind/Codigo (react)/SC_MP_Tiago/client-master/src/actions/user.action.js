import { userConstants } from '../constants';
import { userService } from '../services';
import { alertActions } from './';

function login(username, password) {
    return (dispatch) => {
        dispatch(request({ username }));

        userService.login(username, password).then(
            (user) => {
                dispatch(success(user));
                window.location.pathname = '/';
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request(user) {
        return { type: userConstants.LOGIN_REQUEST, user };
    }

    function success(user) {
        return { type: userConstants.LOGIN_SUCCESS, user };
    }

    function failure(error) {
        return { type: userConstants.LOGIN_FAILURE, error };
    }
}

function logout() {
    userService.logout();

    return { type: userConstants.LOGOUT };
}

function create(newUser) {
    return (dispatch) => {
        dispatch(request());

        userService.create(newUser).then(
            (res) => {
                dispatch(success(res));
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: userConstants.CREATE_REQUEST };
    }

    function success(res) {
        return { type: userConstants.CREATE_SUCCESS, res };
    }

    function failure(error) {
        return { type: userConstants.CREATE_FAILURE, error };
    }
}

function getAll() {
    return (dispatch) => {
        dispatch(request());

        userService.getAll().then(
            (users) => dispatch(success(users)),
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: userConstants.GET_ALL_REQUEST };
    }

    function success(users) {
        return { type: userConstants.GET_ALL_SUCCESS, users };
    }

    function failure(error) {
        return { type: userConstants.GET_ALL_FAILURE, error };
    }
}

function update(changedUser) {
    return (dispatch) => {
        dispatch(request());

        userService.update(changedUser).then(
            (res) => {
                dispatch(success(res));
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: userConstants.UPDATE_REQUEST };
    }

    function success(res) {
        return { type: userConstants.UPDATE_SUCCESS, res };
    }

    function failure(error) {
        return { type: userConstants.UPDATE_REQUEST, error };
    }
}

function destroy(userId) {
    return (dispatch) => {
        dispatch(request());

        userService.erase(userId).then(
            (user) => {
                dispatch(success());
            },
            (error) => {
                dispatch(failure(error));
                dispatch(alertActions.error(error));
            },
        );
    };

    function request() {
        return { type: userConstants.DELETE_REQUEST };
    }

    function success() {
        return { type: userConstants.DELETE_SUCCESS };
    }

    function failure(error) {
        return { type: userConstants.DELETE_FAILURE, error };
    }
}

export const userActions = {
    login,
    logout,
    getAll,
    create,
    update,
    destroy,
};
