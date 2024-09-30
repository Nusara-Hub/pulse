import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';

const schema = z.object({
    'employee_id': z.string().nonempty(),
    'shiftment_id': z.string(),
    'check_in': z.string(),
    'check_out': z.string(),
    'attendance_date': z.date(),
    'is_absent': z.boolean(),
    'reason_id': z.string(),
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
        window.location.href = '/pulse/attendance';
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
                    <label className='block text-sm font-bold mb-2' htmlFor='check_in'>
                        Check  In
                    </label>
                    <Input
                        type='string'
                        {...register('check_in')}
                        className='input input-bordered w-full'
                        placeholder='Check  In'
                    />
                    {errors.check_in && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.check_in.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='check_out'>
                        Check  Out
                    </label>
                    <Input
                        type='string'
                        {...register('check_out')}
                        className='input input-bordered w-full'
                        placeholder='Check  Out'
                    />
                    {errors.check_out && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.check_out.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='attendance_date'>
                        Attendance  Date
                    </label>
                    <Input
                        type='date'
                        {...register('attendance_date')}
                        className='input input-bordered w-full'
                        placeholder='Attendance  Date'
                    />
                    {errors.attendance_date && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.attendance_date.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='is_absent'>
                        Absen
                    </label>
                    <Input
                        type='boolean'
                        {...register('is_absent')}
                        className='input input-bordered w-full'
                        placeholder='Absen'
                    />
                    {errors.is_absent && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.is_absent.message}
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
