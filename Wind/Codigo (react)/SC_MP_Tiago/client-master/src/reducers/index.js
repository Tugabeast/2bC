import { combineReducers } from 'redux';
import { auth } from './auth.reducer';
import { users } from './user.reducer';
import { alert } from './alert.reducer';
import { registeredCards } from './registeredCards.reducer';
import { meetingPoint } from './meetingPoint.reducer';
import { meetingPointOperation } from './meetingPointOperation.reducer';
import { meetingPointStatus } from './meetingPointStatus.reducer';
import { wind } from './wind.reducer';
import { gvirStatus } from './gvirStatus.reducer';

const rootReducer = combineReducers({
    auth,
    users,
    registeredCards,
    meetingPoint,
    alert,
    meetingPointOperation,
    meetingPointStatus,
    wind,
    gvirStatus,
});

export default rootReducer;
