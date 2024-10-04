import React, { useEffect, useState } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import { DatePicker } from '@/components/ui/datepicker';
import { Textarea } from "@/components/ui/textarea";
import SelectSearch from "@/components/SelectSearch";
import { Skeleton } from "@/components/ui/skeleton"
const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
const schema = z.object({
    'employee_id': z.string(),
    'shiftment_id': z.string(),
    'overtime_date': z.string().refine((val) => dateRegex.test(val), {
        message: "Invalid date format, must be YYYY-MM-DD"
    }),
    'start_hour': z.string().nonempty(),
    'end_hour': z.string().nonempty(),
    'is_holiday': z.boolean(),
    'description': z.string()
});
import { useEmployeeStore } from '../../Employee/State/useEmployeeStore';
import { useShiftmentStore } from '../../Shiftment/State/useShiftmentStore';
const Form = ({ id, onSubmit, initialData = {} }) => {
    const { fetch: employee, datas: dataEmployee = [], loading: loadingEmployee } = useEmployeeStore();
    const { fetch: shiftment, datas: dataShiftment = [], loading: loadingShiftment } = useShiftmentStore();
    const [overtimeDate, setOvertimeDate] = useState(initialData.data?.overtime_date_date || null);
    const {
        register,
        handleSubmit,
        reset,
        setValue,
        formState: { errors },
    } = useForm({
        resolver: zodResolver(schema),
    });

    useEffect(() => {
        reset(initialData.data);
        setOvertimeDate(initialData.data?.overtime_date || null);
        employee();
        shiftment();
    }, [id, reset, initialData]);

    const handleCancel = () => {
        window.location.href = '/pulse/overtime';
    };

    const handleOvertimeDate = (date) => {
        setOvertimeDate(date);
        setValue('overtime_date', date);
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>
                <div className="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='employee_id'>
                                Employee
                            </label>
                            {loadingEmployee ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                                data={dataEmployee.data || []}
                                initialValue={initialData.data?.employee_id || ''}
                                onChange={(value) => setValue('employee_id', value)}
                                value='id'
                                label='fullname'
                                placeholder='Employee'
                            />}
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
                            {loadingShiftment ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                                data={dataShiftment.data || []}
                                initialValue={initialData.data?.shiftment_id || ''}
                                onChange={(value) => setValue('shiftment_id', value)}
                                value='id'
                                label='name'
                                customLabel='name,start_hour,end_hour'
                                placeholder='Shiftment'
                            />}
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
                            <DatePicker
                                initialDate={overtimeDate}
                                onSelectDate={handleOvertimeDate}
                                placeholder="Choose a Overtime Date"
                            />
                            {errors.overtime_date && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.overtime_date.message}
                                </p>
                            )}
                        </div>
                    </div>

                    <div>
                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='start_hour'>
                                Start  Hour
                            </label>
                            <Input
                                type="time"
                                {...register('start_hour')}
                                className='input input-bordered w-full'
                                placeholder='Start  Hour'
                                step="60"
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
                                type="time"
                                {...register('end_hour')}
                                className='input input-bordered w-full'
                                placeholder='End  Hour'
                                step="60"
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
                            <input
                                type='checkbox'
                                {...register('is_holiday')}
                                className='checkbox checkbox-bordered'
                            />
                            {errors.is_holiday && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.is_holiday.message}
                                </p>
                            )}
                        </div>
                    </div>
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='description'>
                        Description
                    </label>
                    <Textarea
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
