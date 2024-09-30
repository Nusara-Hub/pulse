import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';

const schema = z.object({
    'type': z.string(),
'letter_number': z.string(),
'subject': z.string(),
'start_date': z.string(),
'end_date': z.string(),
'signed_date': z.string(),
'description': z.string(),
'tags': z.string()
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
        window.location.href = '/pulse/contract';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>
               
                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='type'>
                        Type of  Contract
                    </label>
                    <Input
                        type='string'
                        {...register('type')}
                        className='input input-bordered w-full'
                        placeholder='Type of  Contract'
                    />
                    {errors.type && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.type.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='letter_number'>
                        No.  Contract
                    </label>
                    <Input
                        type='string'
                        {...register('letter_number')}
                        className='input input-bordered w-full'
                        placeholder='No.  Contract'
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
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='start_date'>
                        Start  Date
                    </label>
                    <Input
                        type='string'
                        {...register('start_date')}
                        className='input input-bordered w-full'
                        placeholder='Start  Date'
                    />
                    {errors.start_date && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.start_date.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='end_date'>
                        End  Date
                    </label>
                    <Input
                        type='string'
                        {...register('end_date')}
                        className='input input-bordered w-full'
                        placeholder='End  Date'
                    />
                    {errors.end_date && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.end_date.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='signed_date'>
                        Signed  Date
                    </label>
                    <Input
                        type='string'
                        {...register('signed_date')}
                        className='input input-bordered w-full'
                        placeholder='Signed  Date'
                    />
                    {errors.signed_date && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.signed_date.message}
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
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='tags'>
                        Tags
                    </label>
                    <Input
                        type='string'
                        {...register('tags')}
                        className='input input-bordered w-full'
                        placeholder='Tags'
                    />
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
