import { registeredCardsConstants } from '../constants';

const initialState = { loading: true, items: {}, error: null };

export function registeredCards(state = initialState, action) {
    switch (action.type) {
        case registeredCardsConstants.GET_ALL_REQUEST:
            return {
                loading: true,
            };

        case registeredCardsConstants.GET_ALL_SUCCESS:
            return {
                items: action.registeredCards,
            };

        case registeredCardsConstants.GET_ALL_FAILURE:
            return {
                error: action.error,
            };

        default:
            return state;
    }
}
