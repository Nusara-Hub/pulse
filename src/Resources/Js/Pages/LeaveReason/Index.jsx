import React, { useEffect } from 'react';
import { useLeaveReasonStore } from './State/useLeaveReasonStore';
import Table from './Components/Table'
import Shimmer from '@/Components/Shimmer';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
const Index = () => {
    const {
        datas,
        loading,
        pagination,
        page,
        limit,
        search,
        setPage,
        setLimit: handleLimitChange,
        handleNextPage,
        handlePreviousPage,
        handleDelete,
        handleSearchChange,
        handleExport,
        fetch
    } = useLeaveReasonStore();
    // Fetch education data when component mounts
    useEffect(() => {
        fetch();
    }, [fetch]);


    return (

        <>
            <Head title="Leave Reason Page" />
            <CardHeader>
                <CardTitle>Leave Reason</CardTitle>
                <CardDescription>Data Leave Reason</CardDescription>
            </CardHeader>
            {loading || !datas?.data ? (
                <Shimmer />
            ) : (
                <Table data={datas.data}
                    onDelete={handleDelete}
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
            )};
        </>

    );
}

export default Index
