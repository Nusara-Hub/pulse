import React from 'react';
import { useEducationInstitute } from './State/useEducationInstitute';
import { Link } from '@inertiajs/react'
import Table from './Components/Table'

const Index = () => {
    const [edu, loading, pagination, page, setPage, limit, search, handleSearchChange, handleLimitChange, handleNextPage, handlePreviousPage, handleDelete] = useEducationInstitute({ read: true, delete: true });
    if (!edu || !edu.data) {
        return <p>Loading...</p>;  // Tampilkan pesan loading saat data belum siap
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
            />
        </>


    );
}

export default Index
