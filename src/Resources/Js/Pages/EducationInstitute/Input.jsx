import React, { useEffect } from 'react';
import { useEducationInstituteStore } from './State/useEducationInstituteStore';
import Form from './Components/Form';
// Define Zod schema for validation
const Input = ({ id }) => {
    // Destructure handleInsert, handleUpdate, and showEducation from the hook
    const { showEducation, detail, handleInsert, handleUpdate } = useEducationInstituteStore();

    useEffect(() => {
        showEducation(id);
    })
    // Handle form submission
    const onSubmit = async (data) => {
        try {
            if (id) {
                // Update data if an ID exists (edit mode)
                await handleUpdate(id, data);
            } else {
                // Insert data if no ID (create mode)
                await handleInsert(data);
            }
            // Navigate back to the index page after success
            window.location.href = '/pulse/education-institute';
        } catch (error) {
            console.error('Error submitting form:', error);
        }
    };

    return (
        <>
            <Form id={id} onSubmit={onSubmit} initialData={detail} />
        </>
    );
};

export default Input;
