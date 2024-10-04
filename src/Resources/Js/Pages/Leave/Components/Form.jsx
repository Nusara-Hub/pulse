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
    'employee_id': z.string().nonempty(),
    'leave_date': z.string().refine((val) => dateRegex.test(val), {
        message: "Invalid date format, must be YYYY-MM-DD"
    }),
    amount: z.string().transform((val) => parseFloat(val)).refine((val) => !isNaN(val), {
        message: "Amount must be a valid number"
    }),
    'reason_id': z.string().nonempty(),
    'description': z.string().nonempty()
});
import { useEmployeeStore } from '../../Employee/State/useEmployeeStore';
import { useLeaveReasonStore } from '../../LeaveReason/State/useLeaveReasonStore';
const Form = ({ id, onSubmit, initialData = {} }) => {
    const { fetch: employee, datas: dataEmployee = [], loading: loadingEmployee } = useEmployeeStore();
    const { fetch: leaveReason, datas: dataLeaveReason = [], loading: loadingLeaveReason } = useLeaveReasonStore();
    const [leaveDate, setLeaveDate] = useState(initialData.data?.leave_date_date || null);
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
        setLeaveDate(initialData.data?.leave_date || null);
        employee();
        leaveReason();
    }, [id, reset, initialData]);

    const handleCancel = () => {
        window.location.href = '/pulse/leave';
    };

    const handleLeaveDate = (date) => {
        setLeaveDate(date);
        setValue('leave_date', date);
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>

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
                    <label className='block text-sm font-bold mb-2' htmlFor='leave_date'>
                        Leave  Date
                    </label>
                    <DatePicker
                        initialDate={leaveDate}
                        onSelectDate={handleLeaveDate}
                        placeholder="Choose a Leave Date"
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
                    {loadingLeaveReason ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                        data={dataLeaveReason.data || []}
                        initialValue={initialData.data?.reason_id || ''}
                        onChange={(value) => setValue('reason_id', value)}
                        value='id'
                        label='name'
                        placeholder='Reason'
                    />}
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
