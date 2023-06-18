import React from 'react';
import { BsFillPersonPlusFill } from 'react-icons/bs';
import { BiEdit, BiSearchAlt } from 'react-icons/bi';
import { IoMdTrash } from 'react-icons/io';
import { useDispatch, useSelector } from 'react-redux';
import { userActions } from '../../actions';
import Loader from '../Loader';
import { capitalize } from '../../helpers';

const UserList = () => {
    const users = useSelector((state) => state.users);

    const dispatch = useDispatch();

    const handleDeletion = async (e, userId) => {
        e.preventDefault();

        await dispatch(userActions.destroy(userId));
        await dispatch(userActions.getAll());
    };

    return (
        <div className='user-list'>
            <h2 className='user-list__title'>Users</h2>
            <div className='user-list__actions'>
                <button
                    className='user-list__create-action'
                    onClick={() =>
                        (window.location.pathname = '/admin/users/create')
                    }
                >
                    <BsFillPersonPlusFill className='user-list__create-action-icon' />
                    Add user
                </button>
            </div>
            <div className='user-list__table-container'>
                <div className='user-list__table'>
                    <div className='user-list__table-head'>
                        <div className='user-list__table-head-cell'>Nome</div>
                        <div className='user-list__table-head-cell'>
                            Username
                        </div>
                        <div className='user-list__table-head-cell'>Email</div>
                        <div className='user-list__table-head-cell'>
                            Phone Number
                        </div>
                        <div className='user-list__table-head-cell'>Role</div>
                        <div className='user-list__table-head-cell'>
                            Actions
                        </div>
                    </div>
                    <div className='user-list__table-body'>
                        {!users.loading && users.items ? (
                            users.items.map((user) => {
                                return (
                                    <div className='user-list__table-body-row'>
                                        <div
                                            className='user-list__table-body-cell'
                                            data-title='Nome'
                                        >
                                            {user.name}
                                        </div>
                                        <div
                                            className='user-list__table-body-cell'
                                            data-title='Username'
                                        >
                                            {user.username}
                                        </div>
                                        <div
                                            className='user-list__table-body-cell'
                                            data-title='Email'
                                        >
                                            {user.email}
                                        </div>
                                        <div
                                            className='user-list__table-body-cell'
                                            data-title='Phone Number'
                                        >
                                            {user.phoneNumber}
                                        </div>
                                        <div
                                            className='user-list__table-body-cell'
                                            data-title='Role'
                                        >
                                            {capitalize(user.role)}
                                        </div>
                                        <div className='user-list__table-body-cell user-list__table-body-cell--flex'>
                                            <button
                                                className='user-list__table-body-button'
                                                onClick={() =>
                                                    (window.location.pathname = `/admin/users/update/${user.id}`)
                                                }
                                            >
                                                <BiEdit className='user-list__table-body-button-icon--green' />
                                            </button>
                                            <button
                                                className='user-list__table-body-button'
                                                onClick={(e) =>
                                                    handleDeletion(e, user.id)
                                                }
                                            >
                                                <IoMdTrash className='user-list__table-body-button-icon--red' />
                                            </button>
                                        </div>
                                    </div>
                                );
                            })
                        ) : (
                            <Loader />
                        )}
                    </div>
                </div>
            </div>
        </div>
    );
};

export default UserList;
