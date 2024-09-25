import React, { useEffect } from 'react';
import { useEducationTitleStore } from './State/useEducationTitleStore';
import Table from './Components/Table'
import { Head } from '@inertiajs/react'
import Shimmer from '@/Components/Shimmer';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
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
    } = useEducationTitleStore();
    // Fetch education data when component mounts
    useEffect(() => {
        fetch();
    }, [fetch]);


    return (

        <>
            <Head title="Education Title Page" />
            <CardHeader>
                <CardTitle>Education Title</CardTitle>
                <CardDescription>Data Education Title</CardDescription>
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
