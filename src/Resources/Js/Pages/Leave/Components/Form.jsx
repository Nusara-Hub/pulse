import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';

const schema = z.object({
    'employee_id': z.string().nonempty(),
'leave_date': z.string().nonempty(),
'amount': z.number(),
'reason_id': z.string().nonempty(),
'description': z.string().nonempty()
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
        window.location.href = '/pulse/leave';
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
                    <label className='block text-sm font-bold mb-2' htmlFor='leave_date'>
                        Leave  Date
                    </label>
                    <Input
                        type='string'
                        {...register('leave_date')}
                        className='input input-bordered w-full'
                        placeholder='Leave  Date'
                    />
                    {errors.leave_date && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.leave_date.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='amount'>
                        Number of  Days
                    </label>
                    <Input
                        type='number'
                        {...register('amount')}
                        className='input input-bordered w-full'
                        placeholder='Number of  Days'
                    />
                    {errors.amount && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.amount.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='reason_id'>
                        Reason
                    </label>
                    <Input
                        type='string'
                        {...register('reason_id')}
                        className='input input-bordered w-full'
                        placeholder='Reason'
                    />
                    {errors.reason_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.reason_id.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='description'>
                        Description
                    </label>
                    <Input
                        type='string'
                        {...register('description')}
                        className='input input-bordered w-full'
                        placeholder='Description'
                    />
                    {errors.description && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.description.message}
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
