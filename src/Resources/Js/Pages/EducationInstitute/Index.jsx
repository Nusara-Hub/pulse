import React, { useEffect } from 'react';
import { useEducationInstituteStore } from './State/useEducationInstituteStore';
import Table from './Components/Table'
import { Head } from '@inertiajs/react'
import Shimmer from '@/Components/Shimmer';

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
    } = useEducationInstituteStore();
    // Fetch education data when component mounts
    useEffect(() => {
        fetch();
    }, [fetch]);


    return (

        <>
            <Head title="Education Institute Page" />
            {loading || !datas?.data ? (
                <Shimmer />  // Show shimmer while loading
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
