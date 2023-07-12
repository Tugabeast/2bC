import React, { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { userActions } from '../../../actions';
import Loader from '../../Loader';

const UpdateUser = ({ userId }) => {
    const users = useSelector((state) => state.users);
    const alert = useSelector((state) => state.alert);

    const dispatch = useDispatch();

    let user = {};

    const getUsers = async () => {
        await dispatch(userActions.getAll());
    };

    const [changedUser, setChangedUser] = useState({
        id: userId,
        name: '',
        email: '',
        username: '',
        phoneNumber: 0,
        role: '',
    });

    const [messages, setMessages] = useState({
        success: '',
        error: '',
    });

    const handleSubmission = async (e) => {
        e.preventDefault();

        delete changedUser.username;

        await dispatch(userActions.update(changedUser));

        setMessages({ success: users.message, error: alert.message });

        if (!messages.error) await getUsers();
    };

    useEffect(() => {
        getUsers();
    }, []);

    useEffect(() => {
        if (!users.loading) {
            user = users.items.filter((user) => user.id === userId)[0];

            setChangedUser({
                ...changedUser,
                name: user.name,
                email: user.email,
                username: user.username,
                phoneNumber: user.phoneNumber,
                role: user.role,
            });
        }
    }, [users.items]);

    useEffect(() => {
        setMessages({ ...messages, error: alert.message });
    }, [alert]);

    return (
        <div className='update-user'>
            <h2 className='update-user__title'>Update user</h2>
            {!users.loading && user ? (
                <div className='update-user__form-container'>
                    <form className='update-user__form'>
                        <div className='update-user__form-group'>
                            <label
                                htmlFor='name'
                                className='update-user__form-label'
                            >
                                Name
                            </label>
                            <input
                                type='text'
                                className='update-user__form-input'
                                id='name'
                                name='name'
                                required
                                value={changedUser.name}
                                onChange={(e) =>
                                    setChangedUser({
                                        ...changedUser,
                                        name: e.target.value,
                                    })
                                }
                            />
                        </div>
                        <div className='update-user__form-group'>
                            <label
                                htmlFor='username'
                                className='update-user__form-label'
                            >
                                Username
                            </label>
                            <input
                                type='text'
                                className='update-user__form-input--disabled'
                                id='username'
                                name='username'
                                disabled
                                value={changedUser.username}
                            />
                        </div>
                        <div className='update-user__form-group'>
                            <label
                                htmlFor='email'
                                className='update-user__form-label'
                            >
                                Email
                            </label>
                            <input
                                type='email'
                                className='update-user__form-input'
                                id='email'
                                name='email'
                                required
                                value={changedUser.email}
                                onChange={(e) =>
                                    setChangedUser({
                                        ...changedUser,
                                        email: e.target.value,
                                    })
                                }
                            />
                        </div>
                        <div className='update-user__form-group'>
                            <label
                                htmlFor='phoneNumber'
                                className='update-user__form-label'
                            >
                                Phone number
                            </label>
                            <input
                                type='tel'
                                className='update-user__form-input'
                                id='phoneNumber'
                                name='phoneNumber'
                                required
                                value={changedUser.phoneNumber}
                                onChange={(e) =>
                                    setChangedUser({
                                        ...changedUser,
                                        phoneNumber: e.target.value,
                                    })
                                }
                            />
                        </div>
                        <div className='update-user__form-group'>
                            <label
                                htmlFor='role'
                                className='update-user__form-label'
                            >
                                Role
                            </label>
                            <select
                                className='update-user__form-input'
                                id='role'
                                name='role'
                                required
                                value={changedUser.role}
                                onChange={(e) =>
                                    setChangedUser({
                                        ...changedUser,
                                        role: e.target.value,
                                    })
                                }
                            >
                                <option value='' disabled />
                                <option value='user'>User</option>
                                <option value='admin'>Administrador</option>
                            </select>
                        </div>
                        <div className='update-user__form-group--buttons'>
                            <button
                                className='update-user__form-button--green'
                                type='button'
                                onClick={() =>
                                    (window.location.pathname = '/admin')
                                }
                            >
                                Go back
                            </button>
                            <button
                                className='update-user__form-button'
                                type='submit'
                                onClick={(e) => handleSubmission(e)}
                            >
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            ) : (
                <Loader />
            )}
            {messages.success ? (
                <div className='update-user__container-message--success'>
                    <p className='update-user__message'>{messages.success}</p>
                </div>
            ) : null}
            {messages.error ? (
                <div className='update-user__container-message--error'>
                    <p className='update-user__message'>{messages.error}</p>
                </div>
            ) : null}
        </div>
    );
};

export default UpdateUser;
