import React, { useEffect, useState } from 'react';
import { useEducationInstituteStore } from './State/useEducationInstituteStore';
import Form from './Components/Form';
// Define Zod schema for validation
const Input = ({ id }) => {
    // Destructure handleInsert, handleUpdate, and showEducation from the hook
    const { show, detail, handleInsert, handleUpdate } = useEducationInstituteStore();
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
            } else {
                await handleInsert(data);  // Create new entry
            }
            window.location.href = '/pulse/education-institute';  // Redirect after success
        } catch (error) {
            console.error('Error submitting form:', error);
        }
    };

    if (loading) {
        return <div>Loading...</div>;  // Show a loading state while data is being fetched
    }

    return (
        <>
            <Form id={id} onSubmit={onSubmit} initialData={detail} />
        </>
    );
};

export default Input;
