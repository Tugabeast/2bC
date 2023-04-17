import React, { useState } from 'react';
import meetingPoint from '../assets/images/meeting-point.svg';
import { FiLogOut } from 'react-icons/fi';
import { GiCctvCamera, GiWindsock } from 'react-icons/gi';
import { FaUserShield } from 'react-icons/fa';
import { CgMenuRight } from 'react-icons/cg';
import { connect } from 'react-redux';

const Header = ({ user }) => {
    const [showNav, setShowNav] = useState(false);

    return (
        <header className='header'>
            <div className='header__left-side'>
                <div className='header__top'>
                    <a href='/' className='header__logo-text'>
                        <img
                            src={meetingPoint}
                            className='header__logo'
                            alt='Meeting point logo'
                        />
                        Meeting point
                    </a>
                    <button
                        className='header__toggle-button'
                        onClick={() => {
                            setShowNav(!showNav);
                        }}
                    >
                        <CgMenuRight className='header__toggle-button-icon' />
                    </button>
                </div>
                <nav className={showNav ? 'header__nav--show' : 'header__nav'}>
                    <ul className='header__ul'>
                        <li className='header__li'>
                            <a href='/gvir' className='header__link'>
                                <GiCctvCamera className='header__link-icon' />
                                <span className='header__link-text'>GVIR</span>
                            </a>
                        </li>
                        <li className='header__li'>
                            <a href='/wind' className='header__link'>
                                <GiWindsock className='header__link-icon' />
                                <span className='header__link-text'>Wind</span>
                            </a>
                        </li>
                        {user.role === 'admin' ? (
                            <li className='header__li'>
                                <a href='/admin' className='header__link'>
                                    <FaUserShield className='header__link-icon' />
                                    <span className='header__link-text'>
                                        Admin
                                    </span>
                                </a>
                            </li>
                        ) : null}
                    </ul>
                    <button className='header__logout-button'>
                        <FiLogOut className='header__logout-button-icon' />
                        <span className='header__logout-button-text'>
                            Logout
                        </span>
                    </button>
                </nav>
            </div>
            <div className='header__right-side'>
                <div className='header__logout'>
                    <button
                        className='header__logout-button'
                        onClick={() => (window.location.href = '/login')}
                    >
                        <FiLogOut className='header__logout-button-icon' />
                        <span className='header__logout-button-text'>
                            Logout
                        </span>
                    </button>
                </div>
            </div>
        </header>
    );
};

function mapStateToProps(state) {
    const { auth } = state;
    const { user } = auth;

    return { user };
}

const connectedHeader = connect(mapStateToProps)(Header);
export { connectedHeader as Header };
