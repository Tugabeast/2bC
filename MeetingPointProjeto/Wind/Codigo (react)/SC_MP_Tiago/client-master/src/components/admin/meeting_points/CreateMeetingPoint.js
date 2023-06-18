import React, { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { meetingPointActions } from '../../../actions';

const CreateMeetingPoint = () => {
    const meetingPoints = useSelector((state) => state.meetingPoint);

    const [newMeetingPoint, setNewMeetingPoint] = useState({
        name: '',
    });

    const [messages, setMessages] = useState({
        success: '',
        error: '',
    });

    const dispatch = useDispatch();

    const handleReset = (e) => {
        e.preventDefault();

        setNewMeetingPoint({
            name: '',
        });

        setMessages({});
    };

    const handleSubmission = async (e) => {
        e.preventDefault();

        await dispatch(meetingPointActions.create(newMeetingPoint));
    };

    useEffect(() => {
        setMessages({
            success: meetingPoints.message,
            error: meetingPoints.error,
        });
    }, [meetingPoints]);

    return (
        <div className='create-meeting-point'>
            <h2 className='create-meeting-point__title'>Create user</h2>
            <div className='create-meeting-point__form-container'>
                <form className='create-meeting-point__form'>
                    <div className='create-meeting-point__form-group'>
                        <label
                            htmlFor='name'
                            className='create-meeting-point__form-label'
                        >
                            Name
                        </label>
                        <input
                            type='text'
                            className='create-meeting-point__form-input'
                            id='name'
                            name='name'
                            required
                            value={newMeetingPoint.name}
                            onChange={(e) =>
                                setNewMeetingPoint({
                                    ...newMeetingPoint,
                                    name: e.target.value,
                                })
                            }
                        />
                    </div>
                    <div className='create-meeting-point__form-group--buttons'>
                        <button
                            className='create-meeting-point__form-button--green'
                            type='button'
                            onClick={() =>
                                (window.location.pathname = '/admin')
                            }
                        >
                            Go back
                        </button>
                        <button
                            className='create-meeting-point__form-button--secondary'
                            type='reset'
                            onClick={(e) => handleReset(e)}
                        >
                            Reset
                        </button>
                        <button
                            className='create-meeting-point__form-button'
                            type='submit'
                            onClick={(e) => handleSubmission(e)}
                        >
                            Create
                        </button>
                    </div>
                </form>
            </div>
            {messages.success ? (
                <div className='create-meeting-point__container-message--success'>
                    <p className='create-meeting-point__message'>
                        {messages.success}
                    </p>
                </div>
            ) : null}
            {messages.error ? (
                <div className='create-meeting-point__container-message--error'>
                    <p className='create-meeting-point__message'>
                        {messages.error}
                    </p>
                </div>
            ) : null}
        </div>
    );
};

export default CreateMeetingPoint;
