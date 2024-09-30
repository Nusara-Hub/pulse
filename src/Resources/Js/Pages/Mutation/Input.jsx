import React, { useEffect, useState } from 'react';
import { useMutationStore } from './State/useMutationStore';
import Form from './Components/Form';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
const Input = ({ id }) => {
    const { show, detail, handleInsert, handleUpdate } = useMutationStore();
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
                    description: 'Mutation updated successfully!',
                    className: 'bg-green-500 text-white',
                });
            } else {
                await handleInsert(data);
                toast({
                    title: 'Success',
                    description: 'Mutation created successfully!',
                    className: 'bg-green-500 text-white',
                });
            }
            window.location.href = '/pulse/mutation';
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
            <Head title="Mutation Page" />
            <CardHeader>
                <CardTitle>Mutation {id ? 'Update' : 'Create'}</CardTitle>
                <CardDescription>{id ? 'Update' : 'Create'} Mutation</CardDescription>
            </CardHeader>
            <Form id={id} onSubmit={onSubmit} initialData={detail} />
        </>
    );
};

export default Input;
