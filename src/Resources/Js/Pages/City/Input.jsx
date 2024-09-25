import React, { useEffect, useState } from 'react';
import { useCityStore } from './State/useCityStore';
import Form from './Components/Form';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
import { useRegionStore } from '../Region/State/useRegionStore';

const Input = ({ id }) => {
    const { show, detail, handleInsert, handleUpdate } = useCityStore();
    const { datas = [], loading, fetch } = useRegionStore(); // Ensure datas is an array
    const [loadings, setLoadings] = useState(true);

    useEffect(() => {
        fetch(); // Fetch regions
        if (id) {
            setLoadings(true);
            show(id).then(() => setLoadings(false)); // Fetch city details if id is provided
        } else {
            setLoadings(false); // Set loadings to false when no id is provided
        }
    }, [id]);

    const onSubmit = async (data) => {
        try {
            if (id) {
                await handleUpdate(id, data); // Update if id is present
            } else {
                await handleInsert(data); // Insert if no id is present
            }
            window.location.href = '/pulse/city'; // Redirect after submission
        } catch (error) {
            console.error('Error submitting form:', error);
        }
    };

    if (loadings || loading) { // Check for loading states
        return <div>Loading...</div>;
    }

    return (
        <>
            <Head title="City Page" />
            <CardHeader>
                <CardTitle>City {id ? 'Update' : 'Create'}</CardTitle>
                <CardDescription>{id ? 'Update' : 'Create'} City</CardDescription>
            </CardHeader>
            <Form id={id} onSubmit={onSubmit} initialData={detail} region={datas.data || []} /> {/* Ensure region is an array */}
        </>
    );
};

export default Input;
