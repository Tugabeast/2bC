import React, { useEffect, useState } from 'react';
import { BsPeopleFill } from 'react-icons/bs';
import { useSelector } from 'react-redux';
import WorkersOnMeetingPoint from './WorkersOnMeetingPoint';

const MeetingPointInfo = ({ id, name }) => {
    const workers = useSelector((state) => state.registeredCards);

    const [count, setCount] = useState(0);

    const [workersOnMeetingPoint, setWorkersOnMeetingPoint] = useState([]);

    const [showModal, setShowModal] = useState(false);

    useEffect(() => {
        setCount(0);
        const workersToAdd = [];

        if (!workers.loading) {
            workers.items.forEach((worker) => {
                if (worker.currentMp === id) {
                    setCount(count + 1);
                    workersToAdd.push({
                        name: worker.name,
                        company: worker.company,
                        job: worker.type,
                    });
                }
            });

            if (workersToAdd) setWorkersOnMeetingPoint(workersToAdd);
        }
    }, [workers.items]);

    return (
        <div className='meeting-point-info'>
            <h4 className='meeting-point-info__number'>MP {id}</h4>
            <h4 className='meeting-point-info__name'>{name}</h4>
            <p className='meeting-point-info__count'>
                <span className='meeting-point-info__count-number'>
                    {count}
                </span>
                <BsPeopleFill />
            </p>
            <button
                className='meeting-point-info__details-button'
                onClick={() => setShowModal(true)}
            >
                Details
            </button>
            <WorkersOnMeetingPoint
                showModal={showModal}
                close={() => setShowModal(false)}
                name={name}
                id={id}
                workers={workersOnMeetingPoint}
            />
        </div>
    );
};

export default MeetingPointInfo;
