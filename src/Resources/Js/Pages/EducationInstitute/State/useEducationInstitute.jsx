import { useEffect, useCallback, useState } from 'react';
import { getData, createData, updateData, deleteData, showData } from '../Services/EducationInstituteService';

export const useEducationInstitute = (options = {read: false, insert: false, update: false, show: false}) => {
    // Inisialisasi state untuk menyimpan data education institute
    const [edu, setEducation] = useState([]);
    const [detail, setDetail] = useState([]);
    const [page, setPage] = useState(1);
    const [limit, setLimit] = useState(10); // Default limit set to 10
    const [search, setSearch] = useState('');
    const [pagination, setPagination] = useState({
        total_data: 0,
        total_filtered: 0,
        current_page: 1,
        total_pages: 1,
        previous_page: null,
        next_page: null
    });
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);

    // Function untuk fetch data education institute
    const fetchEducation = useCallback(async () => {
        console.log(limit);
        setLoading(true);
        getData(page, limit, search)
            .then(data => {
                setLoading(false);
                setEducation(data);
                setPagination(data.pagination);
            })
            .catch(error => {
                console.error('There was an error fetching the data!', error);
            });
    }, [setEducation, page, limit, search]);

    const showEducation = useCallback((id) => {
        console.log(id);
        showData(id)
            .then(data => {
                console.log(data);
                setDetail(data);
            })
            .catch(error => {
                console.error('There was an error fetching the data!', error);
            });
    }, [setEducation]);

    // Auto-fetch data saat komponen pertama kali dirender, jika opsi read tidak di-set ke false

    useEffect(() => {
        if (options.read) {
            fetchEducation();
        }
    }, [fetchEducation, options.read]);

    // Show detail if options.show is true and id is provided
    useEffect(() => {
        if (options.show && options.id) {
            showEducation(options.id);
        }
    }, [showEducation, options.show, options.id]);

    // Handler untuk menambah data
    const handleInsert = useCallback((data) => {
        if(data){
        return createData(data)
            .then(res => {
                fetchEducation();
                return res;
            })
            .catch(error => {
                console.error('There was an error inserting the user!', error);
                throw error;
            });
        }
    }, [fetchEducation]);

    // Handler untuk mengupdate data
    const handleUpdate = useCallback((id, data) => {
        if(data){
        return updateData(id, data)
            .then(res => {
                fetchEducation();
                return res;
            })
            .catch(error => {
                console.error('There was an error updating the user!', error);
                throw error;
            });
        }
    }, [fetchEducation]);

    // Handler untuk menghapus data
    const handleDelete = useCallback((id) => {
        if(id){
        return deleteData(id)
            .then((res) => {
                fetchEducation();
                return res;
            })
            .catch(error => {
                console.error('There was an error deleting the user!', error);
                throw error;
            });
        }
    }, [fetchEducation]);

    const handleSearchChange = (newSearch) => {
        setSearch(newSearch);
        setPage(1); // Reset to first page when search changes
    };

    const handleLimitChange = (newLimit) => {
        setLimit(newLimit);
        setPage(1); // Reset to first page when limit changes
    };

    const handleNextPage = () => {
        if (page < pagination.total_pages) {
            setPage(page + 1);
        }
    };

    const handlePreviousPage = () => {
        if (page > 1) {
            setPage(page - 1);
        }
    };

    // Return nilai berdasarkan opsi yang diterima
    const result = [];
    if (options.read) {
        result.push(edu);
        result.push(loading);
        result.push(pagination);
        result.push(page);
        result.push(setPage);
        result.push(limit);
        result.push(search);
        result.push(handleSearchChange);
        result.push(handleLimitChange);
        result.push(handleNextPage);
        result.push(handlePreviousPage);
    }
    if(options.show) result.push(detail);
    if (options.insert) result.push(handleInsert);
    if (options.update) result.push(handleUpdate);
    if (options.delete) result.push(handleDelete);

    return result;
};
