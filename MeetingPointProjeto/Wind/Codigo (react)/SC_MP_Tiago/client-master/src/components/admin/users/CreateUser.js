import React, { useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { userActions } from '../../../actions';

const CreateUser = () => {
    const users = useSelector((state) => state.users);

    const [newUser, setNewUser] = useState({
        name: '',
        username: '',
        email: '',
        phoneNumber: '',
        password: '',
    });

    const [messages, setMessages] = useState({
        success: '',
        error: '',
    });

    const dispatch = useDispatch();

    const handleReset = (e) => {
        e.preventDefault();

        setNewUser({
            name: '',
            username: '',
            email: '',
            phoneNumber: '',
            password: '',
            role: '',
        });

        setMessages({});
    };

    const handleSubmission = async (e) => {
        e.preventDefault();

        await dispatch(userActions.create(newUser));

        setMessages({ success: users.message, error: users.error });

        console.log(messages);
    };

    return (
        <div className='create-user'>
            <h2 className='create-user__title'>Create user</h2>
            <div className='create-user__form-container'>
                <form className='create-user__form'>
                    <div className='create-user__form-group'>
                        <label
                            htmlFor='name'
                            className='create-user__form-label'
                        >
                            Name
                        </label>
                        <input
                            type='text'
                            className='create-user__form-input'
                            id='name'
                            name='name'
                            required
                            value={newUser.name}
                            onChange={(e) =>
                                setNewUser({ ...newUser, name: e.target.value })
                            }
                        />
                    </div>
                    <div className='create-user__form-group'>
                        <label
                            htmlFor='username'
                            className='create-user__form-label'
                        >
                            Username
                        </label>
                        <input
                            type='text'
                            className='create-user__form-input'
                            id='username'
                            name='username'
                            required
                            value={newUser.username}
                            onChange={(e) =>
                                setNewUser({
                                    ...newUser,
                                    username: e.target.value,
                                })
                            }
                        />
                    </div>
                    <div className='create-user__form-group'>
                        <label
                            htmlFor='email'
                            className='create-user__form-label'
                        >
                            Email
                        </label>
                        <input
                            type='email'
                            className='create-user__form-input'
                            id='email'
                            name='email'
                            required
                            value={newUser.email}
                            onChange={(e) =>
                                setNewUser({
                                    ...newUser,
                                    email: e.target.value,
                                })
                            }
                        />
                    </div>
                    <div className='create-user__form-group'>
                        <label
                            htmlFor='phoneNumber'
                            className='create-user__form-label'
                        >
                            Phone number
                        </label>
                        <input
                            type='tel'
                            className='create-user__form-input'
                            id='phoneNumber'
                            name='phoneNumber'
                            required
                            value={newUser.phoneNumber}
                            onChange={(e) =>
                                setNewUser({
                                    ...newUser,
                                    phoneNumber: e.target.value,
                                })
                            }
                        />
                    </div>
                    <div className='create-user__form-group'>
                        <label
                            htmlFor='password'
                            className='create-user__form-label'
                        >
                            Password
                        </label>
                        <input
                            type='password'
                            className='create-user__form-input'
                            id='password'
                            name='password'
                            required
                            value={newUser.password}
                            onChange={(e) =>
                                setNewUser({
                                    ...newUser,
                                    password: e.target.value,
                                })
                            }
                        />
                    </div>
                    <div className='create-user__form-group'>
                        <label
                            htmlFor='role'
                            className='create-user__form-label'
                        >
                            Role
                        </label>
                        <select
                            className='create-user__form-input'
                            id='role'
                            name='role'
                            required
                            value={newUser.role}
                            onChange={(e) =>
                                setNewUser({
                                    ...newUser,
                                    role: e.target.value,
                                })
                            }
                        >
                            <option value='' disabled selected />
                            <option value='user'>User</option>
                            <option value='admin'>Administrador</option>
                        </select>
                    </div>
                    <div className='create-user__form-group--buttons'>
                        <button
                            className='create-user__form-button--green'
                            type='button'
                            onClick={() =>
                                (window.location.pathname = '/admin')
                            }
                        >
                            Go back
                        </button>
                        <button
                            className='create-user__form-button--secondary'
                            type='reset'
                            onClick={(e) => handleReset(e)}
                        >
                            Reset
                        </button>
                        <button
                            className='create-user__form-button'
                            type='submit'
                            onClick={(e) => handleSubmission(e)}
                        >
                            Create
                        </button>
                    </div>
                </form>
            </div>
            {messages.success ? (
                <div className='create-user__container-message--success'>
                    <p className='create-user__message'>{messages.success}</p>
                </div>
            ) : null}
            {messages.error ? (
                <div className='create-user__container-message--error'>
                    <p className='create-user__message'>{messages.error}</p>
                </div>
            ) : null}
        </div>
    );
};

export default CreateUser;
