import React, { useEffect } from 'react';
import {
    LineChart,
    Line,
    XAxis,
    YAxis,
    CartesianGrid,
    Tooltip,
    Legend,
    Brush,
    AreaChart,
    Area,
    ResponsiveContainer,
} from 'recharts';
import { useDispatch, useSelector } from 'react-redux';
import { gvirStatusActions } from '../actions';
import Loader from './Loader';

const GvirBody = () => {
    const gvirStatus = useSelector((state) => state.gvirStatus);

    const gvirItems = gvirStatus.items;

    const dispatch = useDispatch();

    useEffect(() => {
        dispatch(gvirStatusActions.get());
        console.log(gvirStatus);
    }, []);

    return (
        <div className='gvir'>
            <h1 className='gvir__title'>GVIR Status</h1>
            {!gvirStatus.loading && gvirStatus.items ? (
                <div className='gvir__content'>
                    <div className='gvir__table'>
                        <div className='gvir__table-container'>
                            <div className='gvir__table-head'>
                                <div className='gvir__table-head-cell'>
                                    Property
                                </div>
                                <div className='gvir__table-head-cell'>
                                    Value
                                </div>
                            </div>
                            <div className='gvir__table-body'>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='LoRa ID'
                                    >
                                        LoRa ID
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.id}
                                    </div>
                                </div>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Serial Number'
                                    >
                                        Serial Number
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.serialNumber}
                                    </div>
                                </div>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Last Contact'
                                    >
                                        Last Contact
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.dateTime.date.split('.')[0]}
                                    </div>
                                </div>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Status'
                                    >
                                        Status
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.status}
                                    </div>
                                </div>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Gas Concentration'
                                    >
                                        Gas Concentration
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.gasConcentration}
                                    </div>
                                </div>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Sensor Temperature'
                                    >
                                        Sensor Temperature
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.temperature}
                                    </div>
                                </div>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Response Factor'
                                    >
                                        Response Factor
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.responseFactor}
                                    </div>
                                </div>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Sensor Range'
                                    >
                                        Sensor Range
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.sensorRange}
                                    </div>
                                </div>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Cal 100'
                                    >
                                        Cal 100
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.cal100}
                                    </div>
                                </div>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Cal 3000'
                                    >
                                        Cal 3000
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.cal3000}
                                    </div>
                                </div>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Waiting Time'
                                    >
                                        Waiting Time
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.waitingTime}
                                    </div>
                                </div>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Threshold H1 (ppm)'
                                    >
                                        Threshold H1 (ppm)
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.thresholdH1}
                                    </div>
                                </div>
                                <div className='gvir__table-row'>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Threshold H2 (ppm)'
                                    >
                                        Threshold H2 (ppm)
                                    </div>
                                    <div
                                        className='gvir__table-body-cell'
                                        data-title='Value'
                                    >
                                        {gvirItems.thresholdH2}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className='gvir__graph'>
                        <ResponsiveContainer className='gvir__graph-container'>
                            <LineChart
                                width={500}
                                height={200}
                                // data={data}
                                syncId='anyId'
                                margin={{
                                    top: 10,
                                    right: 30,
                                    left: 0,
                                    bottom: 0,
                                }}
                            >
                                <CartesianGrid strokeDasharray='4 4' />
                                <XAxis dataKey='name' />
                                <YAxis />
                                <Tooltip />
                                <Line
                                    type='monotone'
                                    dataKey='pv'
                                    stroke='#094b9b'
                                    fill='#094b9b'
                                />
                                <Brush stroke='#094b9b' />
                            </LineChart>
                        </ResponsiveContainer>
                    </div>
                </div>
            ) : (
                <Loader />
            )}
        </div>
    );
};

export default GvirBody;
