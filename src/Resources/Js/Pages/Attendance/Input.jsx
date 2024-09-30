import React, { useEffect, useState } from 'react';
import { useAttendanceStore } from './State/useAttendanceStore';
import Form from './Components/Form';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
const Input = ({ id }) => {
    const { show, detail, handleInsert, handleUpdate } = useAttendanceStore();
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
                    description: 'Attendance updated successfully!',
                    className: 'bg-green-500 text-white',
                });
            } else {
                await handleInsert(data);
                toast({
                    title: 'Success',
                    description: 'Attendance created successfully!',
                    className: 'bg-green-500 text-white',
                });
            }
            window.location.href = '/pulse/attendance';
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
            <Head title="Attendance Page" />
            <CardHeader>
                <CardTitle>Attendance {id ? 'Update' : 'Create'}</CardTitle>
                <CardDescription>{id ? 'Update' : 'Create'} Attendance</CardDescription>
            </CardHeader>
            <Form id={id} onSubmit={onSubmit} initialData={detail} />
        </>
    );
};

export default Input;
