import React from 'react';
import { BsPlusCircleDotted } from 'react-icons/bs';
import { useDispatch, useSelector } from 'react-redux';
import { meetingPointActions } from '../../actions';
import { BiEdit } from 'react-icons/bi';
import { IoMdTrash } from 'react-icons/io';
import Loader from '../Loader';

const MeetingPointsList = () => {
    const meetingPoints = useSelector((state) => state.meetingPoint);

    const dispatch = useDispatch();

    const handleDeletion = async (e, meetingPointId) => {
        e.preventDefault();

        await dispatch(meetingPointActions.destroy(meetingPointId));
        await dispatch(meetingPointActions.getAll());
    };

    const handleEdition = async (e, meetingPointId) => {
        e.preventDefault();
    };

    return (
        <div className='meeting-points-list'>
            <h2 className='meeting-points-list__title'>Meeting Points</h2>
            <div className='meeting-points-list__actions'>
                <button
                    className='meeting-points-list__create-action'
                    onClick={() =>
                        (window.location.pathname =
                            '/admin/meeting_points/create')
                    }
                >
                    <BsPlusCircleDotted className='meeting-points-list__create-action-icon' />
                    Add meeting point
                </button>
            </div>
            <div className='meeting-points-list__table-container'>
                <div className='meeting-points-list__table'>
                    <div className='meeting-points-list__table-head'>
                        <div className='meeting-points-list__table-head-cell'>
                            Nome
                        </div>
                        <div className='meeting-points-list__table-head-cell'>
                            Actions
                        </div>
                    </div>
                    <div className='meeting-points-list__table-body'>
                        {!meetingPoints.loading && meetingPoints.items ? (
                            meetingPoints.items.map((meetingPoint) => {
                                return (
                                    <div className='meeting-points-list__table-body-row'>
                                        <div
                                            className='meeting-points-list__table-body-cell'
                                            data-title='Nome'
                                        >
                                            {meetingPoint.name}
                                        </div>

                                        <div className='meeting-points-list__table-body-cell meeting-points-list__table-body-cell--flex'>
                                            <button
                                                className='meeting-points-list__table-body-button'
                                                onClick={() =>
                                                    (window.location.pathname = `/admin/meeting_points/update/${meetingPoint.id}`)
                                                }
                                            >
                                                <BiEdit className='meeting-points-list__table-body-button-icon--green' />
                                            </button>
                                            <button
                                                className='meeting-points-list__table-body-button'
                                                onClick={(e) =>
                                                    handleDeletion(
                                                        e,
                                                        meetingPoint.id,
                                                    )
                                                }
                                            >
                                                <IoMdTrash className='meeting-points-list__table-body-button-icon--red' />
                                            </button>
                                        </div>
                                    </div>
                                );
                            })
                        ) : (
                            <Loader />
                        )}
                    </div>
                    {/*<CustomTable*/}
                    {/*    columns={['Nome']}*/}
                    {/*    rows={meetingPoints.items}*/}
                    {/*    buttons={[*/}
                    {/*        {*/}
                    {/*            color: 'green',*/}
                    {/*            icon: BiEdit,*/}
                    {/*            onClickAction: handleEdition,*/}
                    {/*        },*/}
                    {/*        {*/}
                    {/*            color: 'red',*/}
                    {/*            icon: IoMdTrash,*/}
                    {/*            onClickAction: handleDeletion,*/}
                    {/*        },*/}
                    {/*    ]}*/}
                    {/*/>*/}
                </div>
            </div>
        </div>
    );
};

export default MeetingPointsList;
