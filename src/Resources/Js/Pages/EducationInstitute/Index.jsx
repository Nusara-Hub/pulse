import React, { useEffect } from 'react';
import { useEducationInstituteStore } from './State/useEducationInstituteStore';
import { Link } from '@inertiajs/react'
import Table from './Components/Table'

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
