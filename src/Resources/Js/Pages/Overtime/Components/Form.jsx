import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';

const schema = z.object({
    'employee_id': z.string(),
'shiftment_id': z.string(),
'overtime_date': z.date(),
'start_hour': z.string().nonempty(),
'end_hour': z.string().nonempty(),
'is_holiday': z.boolean(),
'description': z.string()
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
        window.location.href = '/pulse/overtime';
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
                    <label className='block text-sm font-bold mb-2' htmlFor='shiftment_id'>
                        Shiftment
                    </label>
                    <Input
                        type='string'
                        {...register('shiftment_id')}
                        className='input input-bordered w-full'
                        placeholder='Shiftment'
                    />
                    {errors.shiftment_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.shiftment_id.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='overtime_date'>
                        Overtime  Date
                    </label>
                    <Input
                        type='date'
                        {...register('overtime_date')}
                        className='input input-bordered w-full'
                        placeholder='Overtime  Date'
                    />
                    {errors.overtime_date && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.overtime_date.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='start_hour'>
                        Start  Hour
                    </label>
                    <Input
                        type='string'
                        {...register('start_hour')}
                        className='input input-bordered w-full'
                        placeholder='Start  Hour'
                    />
                    {errors.start_hour && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.start_hour.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='end_hour'>
                        End  Hour
                    </label>
                    <Input
                        type='string'
                        {...register('end_hour')}
                        className='input input-bordered w-full'
                        placeholder='End  Hour'
                    />
                    {errors.end_hour && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.end_hour.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='is_holiday'>
                        Holiday
                    </label>
                    <Input
                        type='boolean'
                        {...register('is_holiday')}
                        className='input input-bordered w-full'
                        placeholder='Holiday'
                    />
                    {errors.is_holiday && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.is_holiday.message}
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
