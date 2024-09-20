import React, { useEffect } from 'react';
import { useEducationInstituteStore } from './State/useEducationInstituteStore';
import Table from './Components/Table'
import { Head } from '@inertiajs/react'

const Index = () => {
    const {
        edu,
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
        fetchEducation
    } = useEducationInstituteStore();
    // Fetch education data when component mounts
    useEffect(() => {
        fetchEducation();
    }, [fetchEducation]);
    if (loading || !edu?.data) {
        return <p>Loading...</p>;  // Display loading while data is not ready
    }

    return (

        <>
            <Head title="Education Institute Page" />

            <Table data={edu.data}
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
        </>

    );
}

export default Index
