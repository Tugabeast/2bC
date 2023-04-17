import React from 'react';
import { Header } from '../../../components/Header';
import UpdateUser from '../../../components/admin/users/UpdateUser';

const Update = ({ match }) => {
    return (
        <div>
            <Header />
            <UpdateUser userId={match.params.id} />
        </div>
    );
};

export default Update;
