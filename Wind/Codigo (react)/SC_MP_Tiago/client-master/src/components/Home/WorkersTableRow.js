import React from 'react';
import { FiMoreHorizontal } from 'react-icons/fi';

const WorkersTableRow = (props) => {
    return (
        <div className='workers-table__table-body-row'>
            <div className='workers-table__table-body-cell' data-title='Nome'>
                {props.name}
            </div>
            <div
                className='workers-table__table-body-cell'
                data-title='Empresa'
            >
                {props.company}
            </div>
            <div className='workers-table__table-body-cell' data-title='Cargo'>
                {props.job}
            </div>
            <div
                className='workers-table__table-body-cell'
                data-title='Meeting Point'
            >
                {props.currentMp}
            </div>
            <div className='workers-table__table-body-cell'>
                <button className='workers-table__table-body-cell-button'>
                    <FiMoreHorizontal className='workers-table__table-body-cell-button-icon' />
                </button>
            </div>
        </div>
    );
};

export default WorkersTableRow;
