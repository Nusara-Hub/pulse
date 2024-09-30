import React, { useEffect, useState } from 'react';
import { useShiftmentStore } from './State/useShiftmentStore';
import Form from './Components/Form';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
const Input = ({ id }) => {
    const { show, detail, handleInsert, handleUpdate } = useShiftmentStore();
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        if (id) {
            setLoading(true);
            show(id).then(() => setLoading(false));
        } else {
            setLoading(false);
        }
    }, [id]);

    const onSubmit = async (data) => {
        try {
            if (id) {
                await handleUpdate(id, data);
                toast({
                    title: 'Success',
                    description: 'Shiftment updated successfully!',
                    className: 'bg-green-500 text-white',
                });
            } else {
                await handleInsert(data);
                toast({
                    title: 'Success',
                    description: 'Shiftment created successfully!',
                    className: 'bg-green-500 text-white',
                });
            }
            window.location.href = '/pulse/shiftment';
        } catch (error) {
            toast({
                title: 'Error',
                description: 'Error submitting form. Please try again.',
                variant: 'destructive',
            });
            console.error('Error submitting form:', error);
        }
    };

    if (loading) {
        return <div>Loading...</div>;
    }

    return (
        <>
            <Head title="Shiftment Page" />
            <CardHeader>
                <CardTitle>Shiftment {id ? 'Update' : 'Create'}</CardTitle>
                <CardDescription>{id ? 'Update' : 'Create'} Shiftment</CardDescription>
            </CardHeader>
            <Form id={id} onSubmit={onSubmit} initialData={detail} />
        </>
    );
};

export default Input;
