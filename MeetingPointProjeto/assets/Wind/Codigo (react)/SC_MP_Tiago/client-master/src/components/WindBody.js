import React, { useCallback, useEffect, useRef, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { windActions } from '../actions';
import Loader from './Loader';
import { timer } from 'redux-logger/src/helpers';
import { getStringWindDirection } from '../helpers/getStringWindDirection';

const WindBody = () => {
    const wind = useSelector((state) => state.wind);

    const dispatch = useDispatch();

    const bodyRef = useRef();

    const [stringDirection, setStringDirection] = useState();

    const handleKeyPress = useCallback((event) => {
        if (event.key == 'f') fullScreen();
    }, []);

    useEffect(() => {
        // attach the event listener
        document.addEventListener('keydown', handleKeyPress);

        // remove the event listener
        return () => {
            document.removeEventListener('keydown', handleKeyPress);
        };
    }, [handleKeyPress]);

    const fullScreen = () => {
        bodyRef.current.scrollIntoView();
    };

    useEffect(() => {
        dispatch(windActions.get());

        fullScreen();
    }, []);

    useEffect(() => {
        const windDir = wind.items.direction;

        setStringDirection(getStringWindDirection(windDir));
    }, [wind.items.direction]);

    useEffect(() => {
        const timer = setTimeout(() => {
            dispatch(windActions.reload());
        }, 10000);

        return () => clearTimeout(timer);
    });

    return (
        <div className='wind' ref={bodyRef}>
            {!wind.loading ? (
                <div
                    className='wind__background-dimmer'
                    onKeyPress={(e) => handleKeyPress(e)}
                >
                    <>
                        <div className='wind__row'>
                            <span className='wind__direction'>N</span>
                        </div>
                        <div className='wind__row'>
                            <span className='wind__direction'>W</span>
                            <div
                                className='wind__compass'
                                style={{
                                    transform: `rotate(${wind.items.direction}deg)`,
                                }}
                            >
                                <div className='wind__compass-needle' />
                            </div>
                            <span className='wind__direction'>E</span>
                        </div>
                        <div className='wind__row'>
                            <span className='wind__direction'>S</span>
                        </div>
                        <div className='wind__info-row'>
                            <p className='wind__info'>
                                Direção {wind.items.direction}˚{stringDirection}
                            </p>
                            <p className='wind__info'>
                                Velocidade {wind.items.velocity} km/h
                            </p>
                            <p className='wind__info'>
                                Updated at{' '}
                                {wind.items.createdAt.date.split('.')[0]}
                            </p>
                        </div>
                    </>
                </div>
            ) : (
                <Loader />
            )}
        </div>
    );
};

export default WindBody;
