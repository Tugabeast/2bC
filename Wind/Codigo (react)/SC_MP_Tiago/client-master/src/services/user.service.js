import axios from 'axios';
import { authHeader } from '../helpers';

/**
 * Logs the user in
 *
 * @param {string} username
 * @param {string} password
 * @returns {object | Promise}
 */
function login(username, password) {
    return axios
        .post(
            `${process.env.REACT_APP_API_URL}/users/read_one.php`,
            {
                username,
                password,
            },
            { headers: authHeader() },
        )
        .then((res) => {
            // ! When finished remove the user and uncomment the actual user
            const token = res.data.token;
            const user = res.data.user;

            // const user = {
            //     id: 4,
            //     user: 'tmdbts',
            //     email: 'tbrancosilva@hotmail.com',
            //     name: 'Tiago Silva',
            //     role: 'user',
            // };

            localStorage.setItem('token', JSON.stringify(token));
            localStorage.setItem('user', JSON.stringify(user));

            return user;
        })
        .catch((error) => {
            const errorMessages = error.response.data.message;

            return Promise.reject(errorMessages);
        });
}

/**
 * Logs the user out
 */
function logout() {
    localStorage.removeItem('user');
}

function create(newUser) {
    return axios
        .post(`${process.env.REACT_APP_API_URL}/users/create.php`, newUser)
        .then((res) => {
            return res.data;
        })
        .catch((error) => {
            const errorMessage = error.response.data.message;

            if (error.response.status === 401) {
                userService.logout();
                window.location.reload();

                return;
            }

            return Promise.reject(errorMessage);
        });
}

function getAll() {
    return axios
        .get(`${process.env.REACT_APP_API_URL}/users/read.php`, {
            headers: authHeader(),
        })
        .then((res) => {
            return res.data;
        })
        .catch((error) => {
            const errorMessage = error.response.data.message;

            if (error.response.status === 401) {
                userService.logout();
                window.location.reload();

                return;
            }

            return Promise.reject(errorMessage);
        });
}

function update(changedUser) {
    return axios
        .post(
            `${process.env.REACT_APP_API_URL}/users/update.php`,
            changedUser,
            {
                headers: authHeader(),
            },
        )
        .then((res) => {
            return res.data;
        })
        .catch((error) => {
            const errorMessage = error.response.data.message;

            if (error.response.status === 401) {
                userService.logout();
                window.location.reload();

                return;
            }

            return Promise.reject(errorMessage);
        });
}

function erase(userId) {
    return axios
        .post(`${process.env.REACT_APP_API_URL}/users/delete.php`, { userId })
        .then((res) => {
            return res.data;
        })
        .catch((error) => {
            const errorMessage = error.response.data.message;

            if (error.response.status === 401) {
                userService.logout();
                window.location.reload();

                return;
            }

            return Promise.reject(errorMessage);
        });
}

export const userService = { login, logout, getAll, create, update, erase };
