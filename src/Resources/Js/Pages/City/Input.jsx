import React, { useEffect, useState } from 'react';
import { useCityStore } from './State/useCityStore';
import Form from './Components/Form';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
import { useToast } from "@/hooks/use-toast";

const Input = ({ id }) => {
    const { show, detail, handleInsert, handleUpdate } = useCityStore();
    const [loading, setLoading] = useState(true);
    const { toast } = useToast();

    useEffect(() => {
        if (id) {
            setLoading(true);
            show(id).then(() => setLoading(false)); // Fetch city details if id is provided
        } else {
            setLoading(false); // Set loadings to false when no id is provided
        }
    }, [id]);

    const onSubmit = async (data) => {
        try {
            if (id) {
                await handleUpdate(id, data);
                toast({
                    title: 'Success',
                    description: 'City updated successfully!',
                    className: 'bg-green-500 text-white',
                });
            } else {
                await handleInsert(data);
                toast({
                    title: 'Success',
                    description: 'City created successfully!',
                    className: 'bg-green-500 text-white',
                });
            }
            window.location.href = '/pulse/city';
        } catch (error) {
            toast({
                title: 'Error',
                description: 'Error submitting form. Please try again.',
                variant: 'destructive',
            });
            console.error('Error submitting form:', error);
        }
    };

    if (loading) { // Check for loading states
        return <div>Loading...</div>;
    }

    return (
        <>
            <Head title="City Page" />
            <CardHeader>
                <CardTitle>City {id ? 'Update' : 'Create'}</CardTitle>
                <CardDescription>{id ? 'Update' : 'Create'} City</CardDescription>
            </CardHeader>
            <Form id={id} onSubmit={onSubmit} initialData={detail} /> {/* Ensure region is an array */}
        </>
    );
};

export default Input;
