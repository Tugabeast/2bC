import React, { useEffect, useState } from 'react';
import { BsFillPersonFill } from 'react-icons/bs';
import { FaLock } from 'react-icons/fa';
import { useDispatch } from 'react-redux';
import { connect } from 'react-redux';
import { userActions } from '../actions';

const Login = ({ loggingIn }) => {
    const [username, setUsername] = useState('');

    const [password, setPassword] = useState('');

    const [submitted, setSubmitted] = useState(false);

    const dispatch = useDispatch();

    /**
     *
     * @param {Event} e
     */
    const handleSubmit = (e) => {
        e.preventDefault();

        setSubmitted(true);
        // ! When finished remove the user and de addition to the local storage

        const user = {
            id: 4,
            user: 'tmdbts',
            email: 'tbrancosilva@hotmail.com',
            name: 'Tiago Silva',
            role: 'user',
        };

        localStorage.setItem('user', JSON.stringify(user));

        if (username && password)
            dispatch(userActions.login(username, password));
    };

    useEffect(() => {
        dispatch(userActions.logout());
    }, []);

    return (
        <div className='login'>
            <div className='login__project-name'>
                <h1 className='login__project-name-text'>MEETING POINT</h1>
            </div>
            <span className='login__divider' />
            <form className='login__form' onSubmit={(e) => handleSubmit(e)}>
                <div className='login__form-group'>
                    <label htmlFor='username' className='login__label'>
                        <BsFillPersonFill />
                        Username
                    </label>
                    <input
                        type='text'
                        className='login__input'
                        id='username'
                        name='username'
                        autoCapitalize='none'
                        value={username}
                        onChange={(e) => setUsername(e.target.value)}
                    />
                </div>
                <div className='login__form-group'>
                    <label htmlFor='password' className='login__label'>
                        <FaLock />
                        Password
                    </label>
                    <input
                        type='password'
                        className='login__input'
                        id='password'
                        name='password'
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                </div>
                <button type='submit' className='login__submit-button'>
                    {loggingIn ? 'Loading ...' : 'Login'}
                </button>
            </form>
        </div>
    );
};
function mapStateToProps(state) {
    const { loggingIn } = state.auth;
    return { loggingIn };
}

const connectedLoginPage = connect(mapStateToProps)(Login);
export { connectedLoginPage as Login };
