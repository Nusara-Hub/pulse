import React, { useEffect, useState } from 'react';
import { useSalaryAllowanceStore } from './State/useSalaryAllowanceStore';
import Form from './Components/Form';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
import { useToast } from "@/hooks/use-toast";
const Input = ({ id, title, type }) => {
    const { show, detail, handleInsert, handleUpdate } = useSalaryAllowanceStore();
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
        try {
            if (id) {
                await handleUpdate(id, data);
                toast({
                    title: 'Success',
                    description: 'Salary Allowance updated successfully!',
                    className: 'bg-green-500 text-white',
                });
            } else {
                await handleInsert(data);
                toast({
                    title: 'Success',
                    description: 'Salary Allowance created successfully!',
                    className: 'bg-green-500 text-white',
                });
            }
            window.location.href = '/pulse/salary-allowance?type=' + type;
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
            <Head title={`Salary ${title} Page`} />
            <CardHeader>
                <CardTitle>Salary {title} {id ? 'Update' : 'Create'}</CardTitle>
                <CardDescription>{id ? 'Update' : 'Create'} Salary {title} </CardDescription>
            </CardHeader>
            <Form id={id} onSubmit={onSubmit} initialData={detail} title={title} type={type} />
        </>
    );
};

export default Input;
