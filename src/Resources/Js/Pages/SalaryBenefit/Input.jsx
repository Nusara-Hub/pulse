import React, { useEffect, useState } from 'react';
import { useSalaryBenefitStore } from './State/useSalaryBenefitStore';
import Form from './Components/Form';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
const Input = ({ id }) => {
    const { show, detail, handleInsert, handleUpdate } = useSalaryBenefitStore();
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
                    description: 'Salary Benefit updated successfully!',
                    className: 'bg-green-500 text-white',
                });
            } else {
                await handleInsert(data);
                toast({
                    title: 'Success',
                    description: 'Salary Benefit created successfully!',
                    className: 'bg-green-500 text-white',
                });
            }
            window.location.href = '/pulse/salary-benefit';
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
            <Head title="Salary Benefit Page" />
            <CardHeader>
                <CardTitle>Salary Benefit {id ? 'Update' : 'Create'}</CardTitle>
                <CardDescription>{id ? 'Update' : 'Create'} Salary Benefit</CardDescription>
            </CardHeader>
            <Form id={id} onSubmit={onSubmit} initialData={detail} />
        </>
    );
};

export default Input;
