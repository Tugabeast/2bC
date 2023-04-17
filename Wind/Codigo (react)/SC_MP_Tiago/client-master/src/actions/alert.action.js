import { alertConstants } from '../constants';

/**
 *
 * @param {string} message
 * @returns
 */
function success(message) {
    return { type: alertConstants.SUCCESS, message };
}

/**
 *
 * @param {string} message
 * @returns
 */
function error(message) {
    return { type: alertConstants.ERROR, message };
}

/**
 *
 * @returns
 */
function clear() {
    return { type: alertConstants.CLEAR };
}

export const alertActions = { success, error, clear };
