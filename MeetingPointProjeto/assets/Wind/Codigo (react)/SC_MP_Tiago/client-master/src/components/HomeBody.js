import React, { useEffect, useState } from 'react';
import { connect, useDispatch } from 'react-redux';
import {
    meetingPointActions,
    meetingPointStatusActions,
    registeredCardsActions,
    userActions,
} from '../actions';
import Configuration from './Home/Configuration';
import GeneralStatus from './Home/GeneralStatus';
import WorkersTable from './Home/WorkersTable';
import DetailsMeetingPoints from './Home/DetailsMeetingPoints';
import Loader from './Loader';

const HomeBody = ({
    user,
    registeredCards,
    meetingPoint,
    meetingPointStatus,
}) => {
    const [progress, setProgress] = useState(0);

    const [onDutyWorkers, setOnDutyWorkers] = useState([]);

    const dispatch = useDispatch();

    const workers = registeredCards;

    const getOnDutyWorkers = () => {
        const tempOnDutyWorkers = workers.items.filter(
            (card) => card.currentMp > 0,
        );

        const progress =
            (tempOnDutyWorkers.length * 100) / workers.items.length;

        setOnDutyWorkers(tempOnDutyWorkers);

        setProgress(progress ? progress : 0);
    };

    const getMeetingPointStatus = () => {
        const meetingPointsId = [];

        meetingPoint.items.forEach((mp) => {
            meetingPointsId.push(mp.id);
        });

        dispatch(meetingPointStatusActions.getMultiple(meetingPointsId));
    };
    const fetchData = async () => {
        await dispatch(registeredCardsActions.getAll());
        await dispatch(meetingPointActions.getAll());
        await dispatch(userActions.getAll());
    };

    useEffect(() => {
        fetchData();
    }, []);

    useEffect(() => {
        if (!workers.loading) getOnDutyWorkers();
    }, [workers.items]);

    useEffect(() => {
        if (!meetingPoint.loading) getMeetingPointStatus();
    }, [meetingPoint.items]);

    return (
        <div className='home'>
            {!workers.loading &&
            !meetingPoint.loading &&
            !meetingPointStatus.loading ? (
                <>
                    <GeneralStatus
                        onDutyWorkers={onDutyWorkers.length}
                        offDutyWorkers={workers.items.length}
                        progress={progress}
                    />
                    <WorkersTable workers={workers} />
                    <DetailsMeetingPoints />
                    <Configuration />
                </>
            ) : (
                <Loader />
            )}
        </div>

        //     {!workers.loading &&
        //     !meetingPoint.loading &&
        //     !meetingPointStatus.loading ? (
        //         <>
        //             <GeneralStatus
        //                 onDutyWorkers={onDutyWorkers.length}
        //                 offDutyWorkers={workers.items.length}
        //                 progress={progress}
        //             />
        //             <WorkersTable workers={workers} />
        //             <DetailsMeetingPoints />
        //             <Configuration />
        //         </>
        //     ) : (
        //         <Loader />
        //     )}
        // </div>
    );
};

function mapStateToProps(state) {
    const { auth, registeredCards, meetingPoint, meetingPointStatus } = state;
    const { user } = auth;

    return { user, registeredCards, meetingPoint, meetingPointStatus };
}

const connectedHomeBody = connect(mapStateToProps)(HomeBody);
export { connectedHomeBody as HomeBody };
