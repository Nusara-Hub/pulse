import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';

const schema = z.object({
    'employee_id': z.string().nonempty(),
    'department_id': z.string().nonempty(),
    'job_level_id': z.string().nonempty(),
    'job_title_id': z.string().nonempty(),
    'supervisor_id': z.string().nonempty(),
    'contract_id': z.string().nonempty(),
    'is_active': z.boolean()
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
        window.location.href = '/pulse/placement';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='employee_id'>
                        Employee
                    </label>
                    <Input
                        type='string'
                        {...register('employee_id')}
                        className='input input-bordered w-full'
                        placeholder='Employee'
                    />
                    {errors.employee_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.employee_id.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='department_id'>
                        Department
                    </label>
                    <Input
                        type='string'
                        {...register('department_id')}
                        className='input input-bordered w-full'
                        placeholder='Department'
                    />
                    {errors.department_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.department_id.message}
                        </p>
                    )}
                </div>


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
                    <label className='block text-sm font-bold mb-2' htmlFor='job_title_id'>
                        Job  Title
                    </label>
                    <Input
                        type='string'
                        {...register('job_title_id')}
                        className='input input-bordered w-full'
                        placeholder='Job  Title'
                    />
                    {errors.job_title_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.job_title_id.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='supervisor_id'>
                        Supervisor
                    </label>
                    <Input
                        type='string'
                        {...register('supervisor_id')}
                        className='input input-bordered w-full'
                        placeholder='Supervisor'
                    />
                    {errors.supervisor_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.supervisor_id.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='contract_id'>
                        Contract
                    </label>
                    <Input
                        type='string'
                        {...register('contract_id')}
                        className='input input-bordered w-full'
                        placeholder='Contract'
                    />
                    {errors.contract_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.contract_id.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='is_active'>
                        Active
                    </label>
                    <Input
                        type='boolean'
                        {...register('is_active')}
                        className='input input-bordered w-full'
                        placeholder='Active'
                    />
                    {errors.is_active && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.is_active.message}
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
