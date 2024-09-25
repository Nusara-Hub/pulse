import React, { useEffect, useState } from 'react';
import { useSkillStore } from './State/useSkillStore';
import Form from './Components/Form';
import {
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Head } from '@inertiajs/react'
import { useSkillGroupStore } from '../SkillGroup/State/useSkillGroupStore';
const Input = ({ id }) => {
    const { show, detail, handleInsert, handleUpdate } = useSkillStore();
    const { fetch, datas = [], loading } = useSkillGroupStore();
    const [loadings, setLoadings] = useState(true);

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
            } else {

                await handleInsert(data);
            }

            window.location.href = '/pulse/skill';
        } catch (error) {
            console.error('Error submitting form:', error);
        }
    };

    if (loadings || loading) {
        return <div>Loading...</div>;
    }

    return (
        <>
            <Head title="Skill Page" />
            <CardHeader>
                <CardTitle>Skill {id ? 'Update' : 'Create'}</CardTitle>
                <CardDescription>{id ? 'Update' : 'Create'} Skill</CardDescription>
            </CardHeader>
            <Form id={id} onSubmit={onSubmit} initialData={detail} parent={datas.data || []} />
        </>
    );
};

export default Input;
