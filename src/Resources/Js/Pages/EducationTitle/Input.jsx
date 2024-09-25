import React, { useEffect, useState } from 'react';
import { useEducationTitleStore } from './State/useEducationTitleStore';
import Form from './Components/Form';

const Input = ({ id }) => {
    const { show, detail, handleInsert, handleUpdate } = useEducationTitleStore();
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
            } else {

                await handleInsert(data);
            }

            window.location.href = '/pulse/education-title';
        } catch (error) {
            console.error('Error submitting form:', error);
        }
    };

    if (loading) {
        return <div>Loading...</div>;
    }

    return (
        <>
            <Form id={id} onSubmit={onSubmit} initialData={detail} />
        </>
    );
};

export default Input;
