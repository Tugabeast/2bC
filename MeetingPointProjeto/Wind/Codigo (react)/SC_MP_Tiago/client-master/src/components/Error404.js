import React from 'react';
import logo from '../assets/images/meeting-point.svg';
import { FaWalking } from 'react-icons/fa';

const Error404 = () => {
    const handleClick = () => {
        window.location.pathname = '/';
    };

    return (
        <div className='error-404'>
            <div className='error-404__code'>
                <span className='error-404__numbers'>4</span>
                <img src={logo} alt='' className='error-404__logo' />
                <span className='error-404__numbers'>4</span>
            </div>
            <h2 className='error-404__message'>
                Sorry, the page you were looking for was not found.
            </h2>
            <button className='error-404__button' onClick={handleClick}>
                <FaWalking className='error-404__button-logo' />
                Evacuate
            </button>
        </div>
    );
};

export default Error404;
