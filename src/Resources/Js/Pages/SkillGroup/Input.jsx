import React, { useEffect, useState } from 'react';
import { useSkillGroupStore } from './State/useSkillGroupStore';
import Form from './Components/Form';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
import { useToast } from "@/hooks/use-toast";
const Input = ({ id }) => {
    const { fetch, datas = [], loading, show, detail, handleInsert, handleUpdate } = useSkillGroupStore();
    const [loadings, setLoadings] = useState(true);
    const { toast } = useToast();

    useEffect(() => {
        fetch();
        if (id) {
            setLoadings(true);
            show(id).then(() => setLoadings(false));
        } else {
            setLoadings(false);
        }
    }, [id]);

    const onSubmit = async (data) => {
        try {
            if (id) {
                await handleUpdate(id, data);
                toast({
                    title: 'Success',
                    description: 'Skill Group updated successfully!',
                    className: 'bg-green-500 text-white',
                });
            } else {
                await handleInsert(data);
                toast({
                    title: 'Success',
                    description: 'Skill Group created successfully!',
                    className: 'bg-green-500 text-white',
                });
            }

            window.location.href = '/pulse/skill-group';
        } catch (error) {
            toast({
                title: 'Error',
                description: 'Error submitting form. Please try again.',
                variant: 'destructive',
            });
            console.error('Error submitting form:', error);
        }
    };

    if (loading || loadings) {
        return <div>Loading...</div>;
    }

    return (
        <>
            <Head title="Skill Group Page" />
            <CardHeader>
                <CardTitle>Skill Group {id ? 'Update' : 'Create'}</CardTitle>
                <CardDescription>{id ? 'Update' : 'Create'} Skill Group</CardDescription>
            </CardHeader>
            <Form id={id} onSubmit={onSubmit} initialData={detail} parent={datas.data || []} />
        </>
    );
};

export default Input;
