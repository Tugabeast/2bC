import { BrowserRouter, Route, Switch, Router } from 'react-router-dom';
import Home from './views/Home';
import './sass/styles.scss';
import { PrivateRoute } from './components/PrivateRoute';
import { Login } from './views/Login';
import { connect } from 'react-redux';
import { history } from './helpers';
import { alertActions } from './actions';
import Admin from './views/admin/Admin';
import CreateUser from './views/admin/users/Create';
import UpdateUser from './views/admin/users/Update';
import UpdateMeetingPoint from './views/admin/meeting_points/Update';
import CreateMeetingPoint from './views/admin/meeting_points/Create';
import Wind from './views/Wind';
import Roles from './constants/roles.ts';
import Error from './views/Error';
import Gvir from './views/Gvir';

const App = (props) => {
    const { dispatch } = props;

    history.listen((location, action) => {
        dispatch(alertActions.clear());
    });

    return (
        <Router history={history}>
            <Switch>
                <Route path='/login' component={Login} />
                <PrivateRoute
                    exact
                    path='/'
                    roles={[Roles.ADMIN, Roles.USER]}
                    component={Home}
                />
                <PrivateRoute
                    exact
                    path='/gvir'
                    roles={[Roles.ADMIN, Roles.USER]}
                    component={Gvir}
                />
                <PrivateRoute
                    exact
                    path='/wind'
                    roles={[Roles.ADMIN, Roles.USER]}
                    component={Wind}
                />
                <PrivateRoute
                    exact
                    path='/admin'
                    roles={[Roles.ADMIN]}
                    component={Admin}
                />
                <PrivateRoute
                    exact
                    path='/admin/users/create'
                    roles={[Roles.ADMIN]}
                    component={CreateUser}
                />
                <PrivateRoute
                    exact
                    path='/admin/users/update/:id'
                    roles={[Roles.ADMIN]}
                    component={UpdateUser}
                />
                <PrivateRoute
                    exact
                    path='/admin/meeting_points/update/:id'
                    roles={[Roles.ADMIN]}
                    component={UpdateMeetingPoint}
                />
                <PrivateRoute
                    exact
                    path='/admin/meeting_points/create'
                    roles={[Roles.ADMIN]}
                    component={CreateMeetingPoint}
                />
                <Route component={Error} />
            </Switch>
        </Router>
    );
};

const mapStateToProps = (state) => {
    const { alert } = state;

    return { alert };
};

const connectedApp = connect(mapStateToProps)(App);

export { connectedApp as App };
