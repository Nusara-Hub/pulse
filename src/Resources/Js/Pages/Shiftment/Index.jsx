import React, { useEffect } from 'react';
import { useShiftmentStore } from './State/useShiftmentStore';
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
    } = useShiftmentStore();
    // Fetch education data when component mounts
    useEffect(() => {
        fetch();
    }, [fetch]);


    return (

        <>
            <Head title="Shiftment Page" />
            <CardHeader>
                <CardTitle>Shiftment</CardTitle>
                <CardDescription>Data Shiftment</CardDescription>
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
            )}
        </>

    );
}

export default Index
