import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
// Define Zod schema for validation
const schema = z.object({
    name: z.string().min(1, 'Name is required').max(255, 'Name is too long'),
});

const Form = ({ id, onSubmit, initialData = {} }) => {

    const {
        register,
        handleSubmit,
        reset,
        formState: { errors },
    } = useForm({
        resolver: zodResolver(schema), // Use Zod schema for validation
    });

    // Fetch data for the given id if editing
    useEffect(() => {
        reset(initialData.data);
    }, [id, reset, initialData]);

    return (
        <>
            <form className="bg-white  rounded px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>
                <div className="mb-4">
                    <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="name">
                        Name
                    </label>
                    <Input

                        type="text"
                        placeholder="Name"
                        {...register('name')}
                    />
                    {errors.name && <p style={{ color: 'red' }}>{errors.name.message}</p>}
                </div>
                <Button variant="outline" type="submit">
                    Submit
                </Button>

            </form>
        </>
    );
};

export default Form;
