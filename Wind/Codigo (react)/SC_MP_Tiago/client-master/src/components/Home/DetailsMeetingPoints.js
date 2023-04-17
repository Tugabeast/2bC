import React from 'react';
import MeetingPointInfo from './MeetingPointInfo';
import { useSelector } from 'react-redux';
import MeetingPoint from './MeetingPoint';

const DetailsMeetingPoints = () => {
    const meetingPoints = useSelector((state) => state.meetingPoint);

    return (
        <div className='details-meeting-points'>
            <h1 className='details-meeting-points__title'>
                Zonas de meeting points
            </h1>
            <div className='details-meeting-points__meeting-points'>
                {!meetingPoints.loading
                    ? meetingPoints.items.map((meetingPoint) => {
                          return (
                              <MeetingPointInfo
                                  key={meetingPoint.id}
                                  id={meetingPoint.id}
                                  name={meetingPoint.name}
                              />
                          );
                      })
                    : null}
            </div>
        </div>
    );
};

export default DetailsMeetingPoints;
