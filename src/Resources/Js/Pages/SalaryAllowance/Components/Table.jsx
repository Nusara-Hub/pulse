import { React, useState } from 'react';
import { DataTable } from '@/Components/DataTable';
import { Button } from "@/components/ui/button"
import {
    TableCell,
} from "@/components/ui/table"

const Table = ({ title, data, onDelete, pagination, page, setPage, limit, search, handleSearchChange, handleLimitChange, handleNextPage, handlePreviousPage, handleExport, type }) => {
    const header = ['No', 'Employee', 'Component', 'Year', 'Month', 'Benefit Value', 'Action'];;
    const renderBody = (row, index, showConfirm, pagination) => {
        const currentPage = pagination.current_page || 1;
        const limit = pagination.per_page || 10;
        const displayIndex = (currentPage - 1) * limit + (index + 1);

        return (
            <>
                <TableCell>{displayIndex}</TableCell>
                <TableCell>{row.employee?.fullname ?? ""}</TableCell>
                <TableCell>{row.component?.name ?? ""}</TableCell>
                <TableCell>{row.year}</TableCell>
                <TableCell>{row.month}</TableCell>
                <TableCell>{row.benefit_value}</TableCell>

                <TableCell className="flex gap-2">
                    <Button
                        variant="outline"
                        onClick={() => window.location.href = `/pulse/salary-allowance/edit/${row.id}?type=${type}`}
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
                    linkCreate={`/pulse/salary-allowance/create?type=${type}`}
                    header={header}
                    body={(row, index, showConfirm, pagination) => renderBody(row, index, showConfirm, pagination, type)}
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
