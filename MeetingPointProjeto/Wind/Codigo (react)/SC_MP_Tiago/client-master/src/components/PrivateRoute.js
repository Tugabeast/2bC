import React from 'react';
import { Route } from 'react-router-dom';

export const PrivateRoute = ({ component: Component, roles, ...rest }) => {
    const user = JSON.parse(localStorage.getItem('user'));

    if (!user) return (window.location.pathname = '/login');

    if (roles && roles.indexOf(user.role) === -1)
        return (window.location.pathname = '/');

    return <Route {...rest} render={(props) => <Component {...props} />} />;
};
