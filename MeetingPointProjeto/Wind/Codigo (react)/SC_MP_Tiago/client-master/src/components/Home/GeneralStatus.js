import React, { useEffect, useState } from 'react';

const GeneralStatus = (props) => {
    const [showPercentageOnLiquid, setShowPercentageOnLiquid] = useState(false);

    const [windowWidth, setWindowWidth] = useState(window.innerWidth);

    window.addEventListener('resize', () => {
        setWindowWidth(window.innerWidth);
    });

    const canShowPercentageOnLiquid = () => {
        return (
            (windowWidth >= 320 && props.progress >= 15) ||
            (windowWidth >= 375 && props.progress >= 13) ||
            (windowWidth >= 425 && props.progress >= 11) ||
            (windowWidth >= 768 && props.progress >= 6)
        );
    };

    useEffect(() => {
        setShowPercentageOnLiquid(canShowPercentageOnLiquid);
    }, [props.progress, windowWidth]);

    return (
        <div className='general-status'>
            <div className='general-status__container'>
                <div className='general-status__info'>
                    <p className='general-status__description-text'>
                        Trabalhadores registados: {props.onDutyWorkers}
                    </p>
                    <p className='general-status__description-text'>
                        Trabalhadores não registados: {props.offDutyWorkers}
                    </p>
                </div>
                <div className='general-status__progress-bar'>
                    <div
                        className='general-status__progress-bar-fill'
                        style={{ width: `${props.progress}%` }}
                    >
                        <div className='general-status__progress-bar-liquid' />
                        {showPercentageOnLiquid ? (
                            <span className='general-status__progress-bar-percentage'>
                                {props.progress.toFixed(2)}%
                            </span>
                        ) : null}
                    </div>
                </div>
                {!showPercentageOnLiquid ? (
                    <p className='general-status__percentage'>
                        {props.progress.toFixed(2)}%
                    </p>
                ) : null}
            </div>
        </div>
    );
};

export default GeneralStatus;
