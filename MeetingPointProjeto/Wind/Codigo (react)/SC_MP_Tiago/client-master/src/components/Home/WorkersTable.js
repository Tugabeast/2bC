import React, { useState } from 'react';
import WorkersTableRow from './WorkersTableRow';
import { useSelector } from 'react-redux';
import { BiSearchAlt } from 'react-icons/bi';

const WorkersTable = () => {
    const workers = useSelector((state) => state.registeredCards);

    const [filteredWorkers, setFilteredWorkers] = useState(workers.items);

    const filterWorkers = (e) => {
        const keyword = e.target.value;

        if (keyword !== '') {
            const res = workers.items.filter((worker) =>
                worker.name
                    .toLowerCase()
                    .includes(keyword.toString().toLowerCase()),
            );

            setFilteredWorkers(res);

            return;
        }

        setFilteredWorkers(workers.items);
    };

    return (
        <div className='workers-table'>
            <div className='workers-table__search'>
                <input
                    type='search'
                    className='workers-table__search-input'
                    onChange={filterWorkers}
                    placeholder={'Search'}
                />
                <button className='workers-table__search-button'>
                    <BiSearchAlt className='workers-table__search-icon' />
                </button>
            </div>
            <div className='workers-table__table'>
                <div className='workers-table__table-head'>
                    <div className='workers-table__table-head-cell'>Nome</div>
                    <div className='workers-table__table-head-cell'>
                        Empresa
                    </div>
                    <div className='workers-table__table-head-cell'>Cargo</div>
                    <div className='workers-table__table-head-cell'>
                        Meeting Point
                    </div>
                    <div className='workers-table__table-head-cell'>More</div>
                </div>
                <div className='workers-table__table-body'>
                    {filteredWorkers && filteredWorkers.length > 0 ? (
                        filteredWorkers.map((worker) => {
                            return (
                                <WorkersTableRow
                                    key={worker.id}
                                    name={worker.name}
                                    company={worker.company}
                                    job={worker.type}
                                    currentMp={worker.currentMp}
                                />
                            );
                        })
                    ) : (
                        <WorkersTableRow
                            key={0}
                            name={'👷‍♂️ No workers found 🚫'}
                            company={''}
                            job={''}
                            currentMp={''}
                        />
                    )}
                </div>
            </div>
        </div>
    );
};

export default WorkersTable;
