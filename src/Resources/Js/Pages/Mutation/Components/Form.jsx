import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';

const schema = z.object({
    'employee_id': z.string().nonempty(),
'contract_id': z.string().nonempty(),
'new_company_id': z.string().nonempty(),
'new_department_id': z.string().nonempty(),
'type': z.string().nonempty(),
'new_job_level_id': z.string().nonempty(),
'new_job_title_id': z.string().nonempty(),
'new_supervisor_id': z.string()
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
        window.location.href = '/pulse/mutation';
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
                    <label className='block text-sm font-bold mb-2' htmlFor='new_company_id'>
                        Company
                    </label>
                    <Input
                        type='string'
                        {...register('new_company_id')}
                        className='input input-bordered w-full'
                        placeholder='Company'
                    />
                    {errors.new_company_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.new_company_id.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='new_department_id'>
                        Department
                    </label>
                    <Input
                        type='string'
                        {...register('new_department_id')}
                        className='input input-bordered w-full'
                        placeholder='Department'
                    />
                    {errors.new_department_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.new_department_id.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='type'>
                        Type
                    </label>
                    <Input
                        type='string'
                        {...register('type')}
                        className='input input-bordered w-full'
                        placeholder='Type'
                    />
                    {errors.type && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.type.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='new_job_level_id'>
                        New  Job  Level
                    </label>
                    <Input
                        type='string'
                        {...register('new_job_level_id')}
                        className='input input-bordered w-full'
                        placeholder='New  Job  Level'
                    />
                    {errors.new_job_level_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.new_job_level_id.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='new_job_title_id'>
                        New  Job  Title
                    </label>
                    <Input
                        type='string'
                        {...register('new_job_title_id')}
                        className='input input-bordered w-full'
                        placeholder='New  Job  Title'
                    />
                    {errors.new_job_title_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.new_job_title_id.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='new_supervisor_id'>
                        Supervisor
                    </label>
                    <Input
                        type='string'
                        {...register('new_supervisor_id')}
                        className='input input-bordered w-full'
                        placeholder='Supervisor'
                    />
                    {errors.new_supervisor_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.new_supervisor_id.message}
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
