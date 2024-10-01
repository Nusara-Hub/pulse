import { React, useState } from 'react';
import { DataTable } from '@/Components/DataTable';
import { Button } from "@/components/ui/button"
import {
    TableCell,
} from "@/components/ui/table"

const Table = ({ title, data, onDelete, pagination, page, setPage, limit, search, handleSearchChange, handleLimitChange, handleNextPage, handlePreviousPage, handleExport }) => {
    const header = ['No', 'Type of Contract', 'No. Contract', 'Subject', 'Start Date', 'End Date', 'Signed Date', 'Used', 'Action'];;
    const renderBody = (row, index, showConfirm, pagination) => {
        const currentPage = pagination.current_page || 1;
        const limit = pagination.per_page || 10;
        const displayIndex = (currentPage - 1) * limit + (index + 1);
        const formatDate = (dateString) => {
            if (!dateString) return ''; // Handle empty or invalid date strings

            const date = new Date(dateString); // Convert to Date object
            return new Intl.DateTimeFormat('en-GB', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }).format(date); // Format the date
        };
        return (
            <>
                <TableCell>{displayIndex}</TableCell>
                <TableCell>{row.type}</TableCell>
                <TableCell>{row.letter_number}</TableCell>
                <TableCell>{row.subject}</TableCell>
                <TableCell>{formatDate(row.start_date)}</TableCell>
                <TableCell>{formatDate(row.end_date)}</TableCell>
                <TableCell>{formatDate(row.signed_date)}</TableCell>
                <TableCell>{row.used ? 'Yes' : 'No'}</TableCell>

                <TableCell className="flex gap-2">
                    <Button
                        variant="outline"
                        onClick={() => window.location.href = `/pulse/contract/edit/${row.id}`}
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
                    linkCreate='/pulse/contract/create'
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
