import React, { useEffect, useState } from 'react';
import { Button } from "@/Components/ui/button";
import { Input } from "@/components/ui/input";
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import Tags from '@/Components/ui/tags';
import SelectSearch from "@/components/SelectSearch";
import { DatePicker } from '@/components/ui/datepicker';
import { Textarea } from "@/components/ui/textarea";

const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
const schema = z.object({
    'type': z.string(),
    'letter_number': z.string(),
    'subject': z.string(),
    'start_date': z.string().refine((val) => dateRegex.test(val), {
        message: "Invalid date format, must be YYYY-MM-DD"
    }),
    'end_date': z.string().refine((val) => dateRegex.test(val), {
        message: "Invalid date format, must be YYYY-MM-DD"
    }),
    'signed_date': z.string().refine((val) => dateRegex.test(val), {
        message: "Invalid date format, must be YYYY-MM-DD"
    }),
    'description': z.string(),
    'tags': z.array(z.string()).optional()
});

const Form = ({ id, onSubmit, initialData = {} }) => {
    const [startDate, setStartDate] = useState(initialData.data?.start_date || null);
    const [endDate, setEndDate] = useState(initialData.data?.end_date || null);
    const [signedDate, setSignedDate] = useState(initialData.data?.signed_date || null);

    const dataType = [
        { name: 'Contract Employee', id: 'Contract Employee' },
        { name: 'Contract Client', id: 'Contract Client' }
    ];

    const {
        register,
        handleSubmit,
        reset,
        setValue,
        watch,
        formState: { errors },
    } = useForm({
        resolver: zodResolver(schema),
        defaultValues: {
            tags: [], // Set default tags as an empty array
        },
    });

    useEffect(() => {
        reset(initialData.data);
        if (initialData.data?.tags) {
            const tagsArray = initialData.data.tags ? initialData.data.tags.split(',') : [];
            setValue('tags', tagsArray);
        }
        setStartDate(initialData.data?.start_date || null);
        setEndDate(initialData.data?.end_date || null);
        setSignedDate(initialData.data?.signed_date || null);
    }, [id, reset, initialData]);

    const handleCancel = () => {
        window.location.href = '/pulse/contract';
    };

    const handleStartDate = (date) => {
        setStartDate(date);
        setValue('start_date', date);
    };

    const handleEndDate = (date) => {
        setEndDate(date);
        setValue('end_date', date);
    };

    const handleSignedDate = (date) => {
        setSignedDate(date);
        setValue('signed_date', date);
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>

                <div className="grid grid-cols-2 gap-4 mb-4">
                    {/* Grid 1 */}
                    <div>
                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='type'>
                                Type of Contract
                            </label>
                            <SelectSearch
                                data={dataType || []}
                                initialValue={initialData.data?.type || ''}
                                onChange={value => setValue('type', value)}
                                value='id'
                                label='name'
                                placeholder='Type'
                            />
                            {errors.type && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.type.message}
                                </p>
                            )}
                        </div>

                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='letter_number'>
                                No. Contract
                            </label>
                            <Input
                                type='string'
                                {...register('letter_number')}
                                className='input input-bordered w-full'
                                placeholder='No. Contract'
                            />
                            {errors.letter_number && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.letter_number.message}
                                </p>
                            )}
                        </div>

                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='subject'>
                                Subject
                            </label>
                            <Input
                                type='string'
                                {...register('subject')}
                                className='input input-bordered w-full'
                                placeholder='Subject'
                            />
                            {errors.subject && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.subject.message}
                                </p>
                            )}
                        </div>
                    </div>

                    {/* Grid 2 */}
                    <div>
                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='start_date'>
                                Start Date
                            </label>
                            <DatePicker
                                initialDate={startDate}
                                onSelectDate={handleStartDate}
                                placeholder="Choose a Start Date"
                            />
                            {errors.start_date && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.start_date.message}
                                </p>
                            )}
                        </div>

                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='end_date'>
                                End Date
                            </label>
                            <DatePicker
                                initialDate={endDate}
                                onSelectDate={handleEndDate}
                                placeholder="Choose an End Date"
                            />
                            {errors.end_date && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.end_date.message}
                                </p>
                            )}
                        </div>

                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='signed_date'>
                                Signed Date
                            </label>
                            <DatePicker
                                initialDate={signedDate}
                                onSelectDate={handleSignedDate}
                                placeholder="Choose a Signed Date"
                            />
                            {errors.signed_date && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.signed_date.message}
                                </p>
                            )}
                        </div>
                    </div>
                </div>

                {/* Description and Tags */}
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

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='tags'>
                        Tags
                    </label>
                    <Tags setValue={setValue} watch={watch} />
                    {errors.tags && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.tags.message}
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
