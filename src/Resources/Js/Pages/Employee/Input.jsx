import React, { useEffect, useState } from 'react';
import { useEmployeeStore } from './State/useEmployeeStore';
import Form from './Components/Form';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
import { useToast } from "@/hooks/use-toast";
const Input = ({ id }) => {
    const { show, detail, handleInsert, handleUpdate } = useEmployeeStore();
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

        console.log(data.email);
        const formData = new FormData();
        formData.append('code', data.code);
        formData.append('email', data.email);
        formData.append('fullname', data.fullname);
        formData.append('gender', data.gender);
        formData.append('place_of_birth', data.place_of_birth);
        formData.append('date_of_birth', data.date_of_birth);
        formData.append('identity_type', data.identity_type);
        formData.append('identity_number', data.identity_number);
        formData.append('martial_status', data.martial_status);
        formData.append('join_date', data.join_date);
        formData.append('employee_status', data.employee_status);
        if (data.profile_image) {
            formData.append('profile_image', data.profile_image[0]);
        }
        formData.append('contract_id', data.contract_id);
        formData.append('department_id', data.department_id);
        formData.append('job_level_id', data.job_level_id);
        formData.append('job_title_id', data.job_title_id);
        formData.append('education_institute_id', data.education_institute_id);
        formData.append('education_title_id', data.education_title_id);
        if (data.supervisor_id) {
            formData.append('supervisor_id', data.supervisor_id ?? null);
        }
        formData.append('risk_ratio', data.risk_ratio);

        try {
            if (id) {
                formData.append('_method', 'PUT');
                await handleUpdate(id, formData);
                toast({
                    title: 'Success',
                    description: 'Employee updated successfully!',
                    className: 'bg-green-500 text-white',
                });
            } else {
                await handleInsert(formData);
                toast({
                    title: 'Success',
                    description: 'Employee created successfully!',
                    className: 'bg-green-500 text-white',
                });
            }
            window.location.href = '/pulse/employee';
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
            <Head title="Employee Page" />
            <CardHeader>
                <CardTitle>Employee {id ? 'Update' : 'Create'}</CardTitle>
                <CardDescription>{id ? 'Update' : 'Create'} Employee</CardDescription>
            </CardHeader>
            <Form id={id} onSubmit={onSubmit} initialData={detail} />
        </>
    );
};

export default Input;
