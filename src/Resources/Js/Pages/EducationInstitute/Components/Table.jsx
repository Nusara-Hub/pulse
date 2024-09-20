import { React, useState } from 'react';
import { Link } from '@inertiajs/react';
import { DataTable } from '@/Components/DataTable';

const Table = ({ title, data, onDelete, pagination, page, setPage, limit, search, handleSearchChange, handleLimitChange, handleNextPage, handlePreviousPage, handleExport }) => {
    const header = ['No', 'Nama', 'Action'];
    const renderBody = (row, index, showConfirm, pagination) => {
        const currentPage = pagination.current_page || 1;
        const limit = pagination.limit || 10;
        const displayIndex = (currentPage - 1) * limit + (index + 1);

        return (
            <>
                <td className="px-4 py-2">{displayIndex}</td>
                <td className="px-4 py-2">{row.name}</td>
                <td className="px-4 py-2">
                    <button
                        className="bg-emerald-500 text-white px-4 py-2 rounded"
                        onClick={() => window.location.href = `/pulse/education-institute/edit/${row.id}`}
                    >
                        Edit
                    </button>
                    <button
                        onClick={() => showConfirm(row.id)}
                        className="bg-red-500 text-white px-4 py-2 rounded ml-4"
                    >
                        Delete
                    </button>
                </td>
            </>
        );
    };

    return (
        <>
            <div className="container mx-auto py-4 px-5">
                <h1>{title}</h1>

                <DataTable
                    data={data}
                    linkCreate='/pulse/education-institute/create'
                    header={header}
                    body={renderBody}
                    onDelete={onDelete}
                    pagination={pagination}
                    page={page}
                    setPage={setPage}
                    limit={limit}
                    search={search}
                    handleSearchChange={handleSearchChange}
                    handleLimitChange={handleLimitChange}
                    handleNextPage={handleNextPage}
                    handlePreviousPage={handlePreviousPage}
                    handleExport={handleExport}
                />
            </div>
        </>
    )


}


export default Table;
