import React, { useEffect } from 'react';
import { useSalaryAllowanceStore } from './State/useSalaryAllowanceStore';
import Table from './Components/Table'
import Shimmer from '@/Components/Shimmer';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
const Index = (props) => {
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
    } = useSalaryAllowanceStore();
    // Fetch education data when component mounts
    useEffect(() => {
        fetch();
    }, [fetch]);


    return (

        <>
            <Head title={`Salary ${props.title} Page`} />
            <CardHeader>
                <CardTitle>Salary {props.title}</CardTitle>
                <CardDescription>Data Salary {props.title}</CardDescription>
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
                    type={`${props.type}`}
                    title={`${props.title}`}
                />
            )}
        </>

    );
}

export default Index
