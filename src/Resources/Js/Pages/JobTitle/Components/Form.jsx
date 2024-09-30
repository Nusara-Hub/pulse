import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';

const schema = z.object({
    'job_level_id': z.string().nonempty(),
    'code': z.string().nonempty(),
    'name': z.string().nonempty()
});

const Form = ({ id, onSubmit, initialData = {} }) => {

    const {
        register,
        handleSubmit,
        reset,
        formState: { errors },
    } = useForm({
        resolver: zodResolver(schema),
    });

    useEffect(() => {
        reset(initialData.data);
    }, [id, reset, initialData]);

    const handleCancel = () => {
        window.location.href = '/pulse/job-title';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='job_level_id'>
                        Job  Level
                    </label>
                    <Input
                        type='string'
                        {...register('job_level_id')}
                        className='input input-bordered w-full'
                        placeholder='Job  Level'
                    />
                    {errors.job_level_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.job_level_id.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='code'>
                        Position  Code
                    </label>
                    <Input
                        type='string'
                        {...register('code')}
                        className='input input-bordered w-full'
                        placeholder='Position  Code'
                    />
                    {errors.code && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.code.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='name'>
                        Position  Name
                    </label>
                    <Input
                        type='string'
                        {...register('name')}
                        className='input input-bordered w-full'
                        placeholder='Position  Name'
                    />
                    {errors.name && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.name.message}
                        </p>
                    )}
                </div>

                <div className="flex gap-2">
                    <Button type="button" variant="secondary" onClick={handleCancel}>
                        Cancel
                    </Button>
                    <Button type="submit">
                        {id ? 'Update' : 'Submit'}
                    </Button>
                </div>

            </form>
        </>
    );
};

export default Form;
