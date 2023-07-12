import React, { useEffect } from 'react';
import UserList from './admin/UserList';
import { useDispatch, useSelector } from 'react-redux';
import { meetingPointActions, userActions } from '../actions';
import Loader from './Loader';
import MeetingPointsList from './admin/MeetingPointsList';

const AdminBody = () => {
    const users = useSelector((state) => state.users);
    const meetingPoints = useSelector((state) => state.meetingPoint);

    const dispatch = useDispatch();

    const fetchData = async () => {
        await dispatch(userActions.getAll());
        await dispatch(meetingPointActions.getAll());
    };

    useEffect(() => {
        fetchData();
    }, []);

    return (
        <div className='admin'>
            {!users.loading && !meetingPoints.loading ? (
                <>
                    <UserList />
                    <MeetingPointsList />
                </>
            ) : (
                <Loader />
            )}
        </div>
    );
};

export default AdminBody;
