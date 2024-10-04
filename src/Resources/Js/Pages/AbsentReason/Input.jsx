import React, { useEffect, useState } from 'react';
import { useAbsentReasonStore } from './State/useAbsentReasonStore';
import Form from './Components/Form';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
import { useToast } from "@/hooks/use-toast";
const Input = ({ id }) => {
    const { show, detail, handleInsert, handleUpdate } = useAbsentReasonStore();
    const { toast } = useToast();
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
        data.type = "Absent";
        try {
            if (id) {
                await handleUpdate(id, data);
                toast({
                    title: 'Success',
                    description: 'Absent Reason updated successfully!',
                    className: 'bg-green-500 text-white',
                });
            } else {
                await handleInsert(data);
                toast({
                    title: 'Success',
                    description: 'Absent Reason created successfully!',
                    className: 'bg-green-500 text-white',
                });
            }
            window.location.href = '/pulse/absent-reason';
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
            <Head title="Absent Reason Page" />
            <CardHeader>
                <CardTitle>Absent Reason {id ? 'Update' : 'Create'}</CardTitle>
                <CardDescription>{id ? 'Update' : 'Create'} Absent Reason</CardDescription>
            </CardHeader>
            <Form id={id} onSubmit={onSubmit} initialData={detail} />
        </>
    );
};

export default Input;
