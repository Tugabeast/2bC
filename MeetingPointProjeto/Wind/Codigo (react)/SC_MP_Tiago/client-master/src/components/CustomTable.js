import React from 'react';
import { capitalize } from '../helpers';

const CustomTable = ({ columns, rows, buttons, showId = false }) => {
    return (
        <div className='custom-table'>
            <div className='custom-table__table-head'>
                {columns.map((column) => (
                    <div className='custom-table__table-head-cell'>
                        {column}
                    </div>
                ))}
            </div>
            <div className='custom-table__table-body'>
                {rows.map((row) => (
                    <div className='custom-table__table-body-row'>
                        {Object.keys(row).map((rowKey) => {
                            if (!showId && rowKey === 'id') return null;

                            return (
                                <div
                                    className='custom-table__table-body-cell'
                                    data-title={capitalize(rowKey)}
                                >
                                    {row[rowKey]}
                                </div>
                            );
                        })}
                        {buttons ? (
                            <div className='custom-table__table-body-cell custom-table__table-body-cell--flex'>
                                {buttons.map((button) => (
                                    <button
                                        className='custom-table__table-body-button'
                                        onClick={button.onClickAction}
                                    >
                                        <button.icon
                                            className={`custom-table__table-body-button-icon--${button.color}`}
                                        />
                                    </button>
                                ))}
                            </div>
                        ) : null}
                    </div>
                ))}
            </div>
        </div>
    );
};

export default CustomTable;
