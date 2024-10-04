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

// Zod schema with conditional validation
const schema = z.object({
    employee_id: z.string().nonempty('Employee is required'),
    shiftment_id: z.string().nonempty('Shiftment is required'),
    attendance_date: z.string().refine((val) => dateRegex.test(val), {
        message: "Invalid date format, must be YYYY-MM-DD"
    }),
    is_absent: z.boolean(),
    check_in: z.string().nullable().optional(), // optional if absent
    check_out: z.string().nullable().optional(), // optional if absent
    reason_id: z.string().nullable().optional(), // required if absent
    description: z.string().optional(),
}).refine(data => {
    if (data.is_absent) {
        return !!data.reason_id;
    } else {
        return !!data.check_in && !!data.check_out;
    }
}, {
    message: "Either Reason or Check In/Out is required",
    path: ["reason_id"] // Apply error message to Reason if absent, otherwise to Check In/Out
});
import { useEmployeeStore } from '../../Employee/State/useEmployeeStore';
import { useShiftmentStore } from '../../Shiftment/State/useShiftmentStore';
import { useAbsentReasonStore } from '../../AbsentReason/State/useAbsentReasonStore';
const Form = ({ id, onSubmit, initialData = {} }) => {
    const { fetch: employee, datas: dataEmployee = [], loading: loadingEmployee } = useEmployeeStore();
    const { fetch: shiftment, datas: dataShiftment = [], loading: loadingShiftment } = useShiftmentStore();
    const { fetch: reason, datas: dataReason = [], loading: loadingReason } = useAbsentReasonStore();
    const [attendanceDate, setAttendanceDate] = useState(initialData.data?.attendance_date || null);

    const {
        register,
        handleSubmit,
        reset,
        setValue,
        watch,
        formState: { errors },
    } = useForm({
        resolver: zodResolver(schema),
        defaultValues: initialData.data
    });

    const isAbsent = watch('is_absent', initialData.data?.is_absent || false); // Track is_absent

    useEffect(() => {
        reset(initialData.data);
        setAttendanceDate(initialData.data?.attendance_date || null);
        employee();
        shiftment();
        reason();
    }, [id, reset, initialData]);

    const handleAttendanceDate = (date) => {
        setAttendanceDate(date);
        setValue('attendance_date', date);
    };

    const handleCancel = () => {
        window.location.href = '/pulse/attendance';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>
                <div className="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        {/* Employee Input */}
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

                        {/* Shiftment Input */}
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

                        {/* Attendance Date Input */}
                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='attendance_date'>
                                Attendance Date
                            </label>
                            <DatePicker
                                initialDate={attendanceDate}
                                onSelectDate={handleAttendanceDate}
                                placeholder="Choose a Attendance Date"
                            />
                            {errors.attendance_date && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.attendance_date.message}
                                </p>
                            )}
                        </div>

                    </div>

                    <div>

                        {/* Absent Checkbox */}
                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='is_absent'>
                                Absent
                            </label>
                            <input
                                type='checkbox'
                                {...register('is_absent')}
                                className='checkbox checkbox-bordered'
                            />
                            {errors.is_absent && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.is_absent.message}
                                </p>
                            )}
                        </div>

                        {/* Conditionally show Reason or Check In/Out based on absence */}
                        {isAbsent ? (
                            <div className='mb-4'>
                                <label className='block text-sm font-bold mb-2' htmlFor='reason_id'>
                                    Reason
                                </label>
                                {loadingReason ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                                    data={dataReason.data || []}
                                    initialValue={initialData.data?.reason_id || ''}
                                    onChange={(value) => setValue('reason_id', value)}
                                    value='id'
                                    label='reason'
                                    placeholder='Reason'
                                />}
                                {errors.reason_id && (
                                    <p className='text-red-500 text-xs italic'>
                                        {errors.reason_id.message}
                                    </p>
                                )}
                            </div>
                        ) : (
                            <>
                                <div className='mb-4'>
                                    <label className='block text-sm font-bold mb-2' htmlFor='check_in'>
                                        Check In
                                    </label>
                                    <Input
                                        type="time"
                                        {...register('check_in')}
                                        className='input input-bordered w-full'
                                        placeholder='Check In'
                                        step="60"
                                    />
                                    {errors.check_in && (
                                        <p className='text-red-500 text-xs italic'>
                                            {errors.check_in.message}
                                        </p>
                                    )}
                                </div>

                                <div className='mb-4'>
                                    <label className='block text-sm font-bold mb-2' htmlFor='check_out'>
                                        Check Out
                                    </label>
                                    <Input
                                        type="time"
                                        {...register('check_out')}
                                        className='input input-bordered w-full'
                                        placeholder='Check Out'
                                        step="60"
                                    />
                                    {errors.check_out && (
                                        <p className='text-red-500 text-xs italic'>
                                            {errors.check_out.message}
                                        </p>
                                    )}
                                </div>
                            </>
                        )}
                    </div>
                </div>

                {/* Description Input */}
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
