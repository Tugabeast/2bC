import React, { useEffect } from 'react';
import CustomTable from '../CustomTable';

const WorkersOnMeetingPoint = ({ workers, showModal, close, name }) => {
    const handleEscClosing = (e) => {
        if ((e.charCode || e.keyCode) === 27) close();
    };

    useEffect(() => {
        document.body.addEventListener('keydown', handleEscClosing);
        return function cleanUp() {
            document.body.addEventListener('keydown', handleEscClosing);
        };
    }, []);

    return (
        <div
            className={`workers-on-meeting-point ${
                showModal ? 'workers-on-meeting-point--show' : ''
            }`}
            onClick={close}
        >
            <div
                className='workers-on-meeting-point__container'
                onClick={(e) => e.stopPropagation()}
            >
                <div className='workers-on-meeting-point__header'>
                    <h4 className='workers-on-meeting-point__title'>{name}</h4>
                </div>
                <div className='workers-on-meeting-point__body'>
                    {workers.length > 0 ? (
                        <CustomTable
                            columns={['Nome', 'Empresa', 'Cargo']}
                            rows={workers}
                        />
                    ) : (
                        '👷‍♂️ No workers on this meeting point 👷‍♂️'
                    )}
                </div>
                <div className='workers-on-meeting-point__footer'>
                    <button
                        className='workers-on-meeting-point__close-button'
                        onClick={close}
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    );
};

export default WorkersOnMeetingPoint;
