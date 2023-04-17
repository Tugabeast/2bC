import React, { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { meetingPointActions, userActions } from '../../../actions';
import Loader from '../../Loader';

const UpdateMeetingPoint = ({ meetingPointId }) => {
    const meetingPoints = useSelector((state) => state.meetingPoint);

    const dispatch = useDispatch();

    let meetingPoint = {};

    const fetchMeetingPoints = async () => {
        await dispatch(meetingPointActions.getAll());
    };

    const [changedMeetingPoint, setChangedMeetingPoint] = useState({
        id: meetingPointId,
        name: '',
    });

    const [messages, setMessages] = useState({
        success: '',
        error: '',
    });

    const handleSubmission = async (e) => {
        e.preventDefault();

        await dispatch(meetingPointActions.update(changedMeetingPoint));

        setMessages({ success: meetingPoints.message, error: alert.message });

        if (!messages.error) await fetchMeetingPoints();
    };

    useEffect(() => {
        fetchMeetingPoints();
    }, []);

    useEffect(() => {
        setMessages({
            success: meetingPoints.message,
            error: meetingPoints.error,
        });
    }, [meetingPoints]);

    useEffect(() => {
        if (!meetingPoints.loading) {
            meetingPoint = meetingPoints.items.filter(
                (meetingPoint) => meetingPoint.id === meetingPointId,
            )[0];

            setChangedMeetingPoint({
                ...changedMeetingPoint,
                name: meetingPoint.name,
            });
        }
    }, [meetingPoints.items]);

    useEffect(() => {
        setMessages({ ...messages, error: alert.message });
    }, [alert]);

    return (
        <div className='update-meeting-point'>
            <h2 className='update-meeting-point__title'>
                Update meeting point
            </h2>
            {!meetingPoints.loading && meetingPoint ? (
                <div className='update-meeting-point__form-container'>
                    <form className='update-meeting-point__form'>
                        <div className='update-meeting-point__form-group'>
                            <label
                                htmlFor='name'
                                className='update-meeting-point__form-label'
                            >
                                Name
                            </label>
                            <input
                                type='text'
                                className='update-meeting-point__form-input'
                                id='name'
                                name='name'
                                required
                                value={changedMeetingPoint.name}
                                onChange={(e) =>
                                    setChangedMeetingPoint({
                                        ...changedMeetingPoint,
                                        name: e.target.value,
                                    })
                                }
                            />
                        </div>
                        <div className='update-meeting-point__form-group--buttons'>
                            <button
                                className='update-meeting-point__form-button--green'
                                type='button'
                                onClick={() =>
                                    (window.location.pathname = '/admin')
                                }
                            >
                                Go back
                            </button>
                            <button
                                className='update-meeting-point__form-button'
                                type='submit'
                                onClick={(e) => handleSubmission(e)}
                            >
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            ) : (
                <Loader />
            )}
            {messages.success ? (
                <div className='update-meeting-point__container-message--success'>
                    <p className='update-meeting-point__message'>
                        {messages.success}
                    </p>
                </div>
            ) : null}
            {messages.error ? (
                <div className='update-meeting-point__container-message--error'>
                    <p className='update-meeting-point__message'>
                        {messages.error}
                    </p>
                </div>
            ) : null}
        </div>
    );
};

export default UpdateMeetingPoint;
