import { React, useState } from 'react';
import { DataTable } from '@/Components/DataTable';
import { Button } from "@/components/ui/button"
import {
    TableCell,
} from "@/components/ui/table"

const Table = ({ title, data, onDelete, pagination, page, setPage, limit, search, handleSearchChange, handleLimitChange, handleNextPage, handlePreviousPage, handleExport }) => {
    const header = ['No', 'Employee Code', 'Name', 'Gender', 'Email', 'Department', 'Job Level', 'Job Ttitle', 'Employee Status', 'Action'];;
    const renderBody = (row, index, showConfirm, pagination) => {
        const currentPage = pagination.current_page || 1;
        const limit = pagination.per_page || 10;
        const displayIndex = (currentPage - 1) * limit + (index + 1);

        return (
            <>
               <TableCell>{displayIndex}</TableCell>
<TableCell>{row.code}</TableCell>
<TableCell>{row.fullname}</TableCell>
<TableCell>{row.gender}</TableCell>
<TableCell>{row.email}</TableCell>
<TableCell>{row.department?.name??""}</TableCell>
<TableCell>{row.joblevel?.name??""}</TableCell>
<TableCell>{row.jobtitle?.name??""}</TableCell>
<TableCell>{row.employee_status}</TableCell>

            <TableCell className="flex gap-2">
                <Button
                    variant="outline"
                    onClick={() => window.location.href = `/pulse/employee/edit/${row.id}`}
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
                    linkCreate='/pulse/employee/create'
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
