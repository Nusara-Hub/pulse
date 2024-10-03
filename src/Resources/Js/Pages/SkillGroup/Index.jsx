import React, { useEffect } from 'react';
import { useSkillGroupStore } from './State/useSkillGroupStore';
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
    } = useSkillGroupStore();
    // Fetch education data when component mounts
    useEffect(() => {
        fetch();
    }, [fetch]);


    return (

        <>
            <Head title="Skill Group Page" />
            <CardHeader>
                <CardTitle>Skill Group</CardTitle>
                <CardDescription>Data Skill Group</CardDescription>
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
