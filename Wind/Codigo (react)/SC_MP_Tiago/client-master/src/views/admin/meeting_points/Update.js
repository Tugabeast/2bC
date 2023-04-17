import React from 'react';
import { Header } from '../../../components/Header';
import UpdateMeetingPoint from '../../../components/admin/meeting_points/UpdateMeetingPoint';

const Update = ({ match }) => {
    return (
        <div>
            <Header />
            <UpdateMeetingPoint meetingPointId={match.params.id} />
        </div>
    );
};

export default Update;
