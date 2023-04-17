import React from 'react';

const Loader = () => {
    return (
        <div className='loader'>
            <ul className='loader__items'>
                <li className='loader__circle--center' />
                <li className='loader__circle loader__circle--1' />
                <li className='loader__circle loader__circle--2' />
                <li className='loader__circle loader__circle--3' />
                <li className='loader__circle loader__circle--4' />
                <li className='loader__circle loader__circle--5' />
                <li className='loader__circle loader__circle--6' />
                <li className='loader__circle loader__circle--7' />
                <li className='loader__circle loader__circle--8' />
            </ul>
        </div>
    );
};

export default Loader;
