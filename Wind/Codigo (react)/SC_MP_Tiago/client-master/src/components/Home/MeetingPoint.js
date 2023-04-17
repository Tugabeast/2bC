import React, { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { meetingPointOperationActions } from '../../actions';

const MeetingPoint = ({ id, name }) => {
    const meetingPointStatus = useSelector((state) => state.meetingPointStatus);
    const { user } = useSelector((state) => state.auth);

    const [newStatus, setNewStatus] = useState();

    const [status, setStatus] = useState([]);

    const dispatch = useDispatch();

    useEffect(() => {
        if (Array.isArray(id)) {
            setStatus({
                id: null,
                equipmentId: 'Master',
                operation: 'Master controller',
                hwStatus: 'Master controller',
            });

            return;
        }

        if (!meetingPointStatus.loading) {
            const fetchedStatus = meetingPointStatus.items.filter(
                (status) => status.equipmentId === `${id}`,
            );

            fetchedStatus[0]
                ? setStatus(fetchedStatus[0])
                : setStatus({
                      id: null,
                      equipmentId: id,
                      operation: 'Equipment not found',
                      hwStatus: 'Equipment not found',
                  });
        }
    }, [meetingPointStatus.loading]);

    /**
     * Handles the change on the form
     *
     * @param event {Event}
     */
    const handleInputChange = (event) => {
        if (event.target.checked) {
            setNewStatus(event.target.value);
        }
    };

    const handleSubmission = (e) => {
        e.preventDefault();

        if (Array.isArray(id)) {
            id.forEach((item) =>
                dispatch(
                    meetingPointOperationActions.create(
                        item,
                        newStatus,
                        user.name,
                    ),
                ),
            );

            return;
        }

        dispatch(
            meetingPointOperationActions.create(
                status.equipmentId,
                newStatus,
                user.name,
            ),
        );
    };
    return (
        <div className='meeting-point'>
            <h4 className='meeting-point__number'>MP {status.equipmentId}</h4>
            <h4 className='meeting-point__name'>{name}</h4>
            {status ? (
                <p className='meeting-point__status'>{status.operation}</p>
            ) : null}
            <form
                className='meeting-point__form'
                onSubmit={(e) => handleSubmission(e)}
            >
                <div className='meeting-point__form-group'>
                    <label
                        className='meeting-point__form-group-label'
                        htmlFor={`standby${id}`}
                    >
                        Standby
                        <input
                            type='radio'
                            name='changeStatus'
                            id={`standby${id}`}
                            value={'Standby'}
                            onChange={handleInputChange}
                        />
                        <span className='meeting-point__from-custom-radio-check' />
                    </label>
                </div>
                <div className='meeting-point__form-group'>
                    <label
                        className='meeting-point__form-group-label'
                        htmlFor={`emergency${id}`}
                    >
                        Emergência
                        <input
                            type='radio'
                            name='changeStatus'
                            id={`emergency${id}`}
                            value={'Emergency'}
                            onChange={handleInputChange}
                        />
                        <span className='meeting-point__from-custom-radio-check' />
                    </label>
                </div>
                <div className='meeting-point__form-group'>
                    <label
                        className='meeting-point__form-group-label'
                        htmlFor={`evacuation${id}`}
                    >
                        Evacuação
                        <input
                            type='radio'
                            name='changeStatus'
                            id={`evacuation${id}`}
                            value={'Evacuation'}
                            onChange={handleInputChange}
                        />
                        <span className='meeting-point__from-custom-radio-check' />
                    </label>
                </div>
                <div className='meeting-point__form-group'>
                    <label
                        className='meeting-point__form-group-label'
                        htmlFor={`endEmergency${id}`}
                    >
                        Fim de Emergência
                        <input
                            type='radio'
                            name='changeStatus'
                            id={`endEmergency${id}`}
                            value={'End Emergency'}
                            onChange={handleInputChange}
                        />
                        <span className='meeting-point__from-custom-radio-check' />
                    </label>
                </div>
                {status.createdAt ? (
                    <div className='meeting-point__form-group--margin'>
                        <p className='meeting-point__status-update'>
                            Updated {status.createdAt.date.split(' ')[0]}
                        </p>
                        <p className='meeting-point__status-update'>
                            at{' '}
                            {status.createdAt.date.split(' ')[1].split('.')[0]}
                        </p>
                    </div>
                ) : (
                    <div className='meeting-point__form-group--margin'>
                        <p className='meeting-point__status-update' />
                        <p className='meeting-point__status-update' />
                    </div>
                )}
                <button
                    className='meeting-point__form-submit-button'
                    type='submit'
                >
                    Submit
                </button>
            </form>
        </div>
    );
};

export default MeetingPoint;
