import React, { useEffect, useState } from 'react';
import { connect, useDispatch, useSelector } from 'react-redux';
import { meetingPointStatusActions } from '../../actions';
import MeetingPoint from './MeetingPoint';

const Configuration = () => {
    const meetingPoints = useSelector((state) => state.meetingPoint);
    const meetingPointStatus = useSelector((state) => state.meetingPointStatus);

    const [allMeetingPointIds, setAllMeetingPointsIds] = useState([]);

    useEffect(() => {
        const mpIds = [];

        if (!meetingPoints.loading) {
            meetingPoints.items.forEach((mp) => {
                mpIds.push(mp.id);
            });
        }

        setAllMeetingPointsIds(mpIds);
    }, [meetingPoints]);

    return (
        <div className='configuration'>
            <h1 className='configuration__title'>Configuração</h1>
            <div className='configuration__meeting-points'>
                {!meetingPoints.loading && !meetingPointStatus.loading
                    ? meetingPoints.items.map((meetingPoint) => {
                          return (
                              <MeetingPoint
                                  key={meetingPoint.id}
                                  id={meetingPoint.id}
                                  name={meetingPoint.name}
                              />
                          );
                      })
                    : null}
                <MeetingPoint id={allMeetingPointIds} name={'General'} />
                {/*TODO: Add panel to change all at the same time*/}
            </div>
        </div>
    );
};

export default Configuration;
