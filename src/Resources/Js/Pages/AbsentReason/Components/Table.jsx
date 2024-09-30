import { React, useState } from 'react';
import { DataTable } from '@/Components/DataTable';
import { Button } from "@/components/ui/button"
import {
    TableCell,
} from "@/components/ui/table"

const Table = ({ title, data, onDelete, pagination, page, setPage, limit, search, handleSearchChange, handleLimitChange, handleNextPage, handlePreviousPage, handleExport }) => {
    const header = ['No', 'Type Reason', 'Reason Code', 'Reason Name', 'Action'];;
    const renderBody = (row, index, showConfirm, pagination) => {
        const currentPage = pagination.current_page || 1;
        const limit = pagination.per_page || 10;
        const displayIndex = (currentPage - 1) * limit + (index + 1);

        return (
            <>
               <TableCell>{displayIndex}</TableCell>
<TableCell>{row.type}</TableCell>
<TableCell>{row.code}</TableCell>
<TableCell>{row.reason}</TableCell>

            <TableCell className="flex gap-2">
                <Button
                    variant="outline"
                    onClick={() => window.location.href = `/pulse/absent-reason/edit/${row.id}`}
                >
                    Edit
                </Button>
                <Button
                    onClick={() => showConfirm(row.id)}
                    variant="destructive"
                >
                    Delete
                </Button>
            </TableCell>
        
            </>
        );
    };

    return (
        <>
            <div className="container mx-auto py-4 px-5">
                <DataTable
                    data={data}
                    linkCreate='/pulse/absent-reason/create'
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
