import React, { useEffect, useState } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import { DatePicker } from '@/components/ui/datepicker';
const schema = z.object({
    'holiday_date': z.string().nonempty(),
    'name': z.string().nonempty()
});

const Form = ({ id, onSubmit, initialData = {} }) => {
    const [selectedDate, setSelectedDate] = useState(initialData.data?.holiday_date || null);

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
        setSelectedDate(initialData.holiday_date || null);
    }, [id, reset, initialData]);

    const handleCancel = () => {
        window.location.href = '/pulse/holiday';
    };

    const handleDateSelect = (date) => {
        setSelectedDate(date);
        setValue('holiday_date', date ? date.toISOString().split('T')[0] : '');
    };


    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='holiday_date'>
                        Holiday Date
                    </label>
                    <DatePicker
                        initialDate={selectedDate}
                        onSelectDate={handleDateSelect}
                        placeholder="Choose a date"
                    />
                    {errors.holiday_date && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.holiday_date.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='name'>
                        Name
                    </label>
                    <Input
                        type='string'
                        {...register('name')}
                        className='input input-bordered w-full'
                        placeholder='name'
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
