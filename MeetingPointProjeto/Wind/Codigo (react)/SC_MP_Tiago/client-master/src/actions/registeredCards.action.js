import { registeredCardsService } from '../services';
import { registeredCardsConstants } from '../constants';
import { alertActions } from '../actions';

function getAll() {
	return (dispatch) => {
		dispatch(request());

		registeredCardsService.getAll().then(
			(registeredCards) => {
				dispatch(success(registeredCards));
			},
			(error) => {
				dispatch(failure(error));
				dispatch(alertActions.error(error));
			}
		);
	};

	function request() {
		return { type: registeredCardsConstants.GET_ALL_REQUEST };
	}

	function success(registeredCards) {
		return {
			type: registeredCardsConstants.GET_ALL_SUCCESS,
			registeredCards,
		};
	}

	function failure(error) {
		return { type: registeredCardsConstants.GET_ALL_FAILURE, error };
	}
}

export const registeredCardsActions = { getAll };
