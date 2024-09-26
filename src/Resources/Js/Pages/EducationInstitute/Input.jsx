import React, { useEffect, useState } from 'react';
import { useEducationInstituteStore } from './State/useEducationInstituteStore';
import Form from './Components/Form';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
import { useToast } from "@/hooks/use-toast";
const Input = ({ id }) => {
    // Destructure handleInsert, handleUpdate, and showEducation from the hook
    const { show, detail, handleInsert, handleUpdate } = useEducationInstituteStore();
    const { toast } = useToast();
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        if (id) {
            setLoading(true);  // Set loading to true before fetching data
            show(id).then(() => setLoading(false));  // Fetch data and set loading to false when done
        } else {
            setLoading(false);  // No id, so no need to fetch data, just disable loading
        }
    }, [id]); // Only run when `id` changes

    const onSubmit = async (data) => {
        try {
            if (id) {
                await handleUpdate(id, data);  // Update existing entry
                toast({
                    title: 'Success',
                    description: 'Education institute updated successfully!',
                    className: 'bg-green-500 text-white',
                });
            } else {
                await handleInsert(data);  // Create new entry
                toast({
                    title: 'Success',
                    description: 'Education institute created successfully!',
                    className: 'bg-green-500 text-white',
                });
            }
            window.location.href = '/pulse/education-institute';  // Redirect after success
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
        return <div>Loading...</div>;  // Show a loading state while data is being fetched
    }

    return (
        <>
            <Head title="Education Institute Page" />
            <CardHeader>
                <CardTitle>Education Institute {id ? 'Update' : 'Create'}</CardTitle>
                <CardDescription>{id ? 'Update' : 'Create'} education institute</CardDescription>
            </CardHeader>
            <Form id={id} onSubmit={onSubmit} initialData={detail} />
        </>
    );
};

export default Input;
