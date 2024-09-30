import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';

const schema = z.object({
    'code': z.string().nonempty(),
'name': z.string().nonempty(),
'start_hour': z.string().nonempty(),
'end_hour': z.string().nonempty()
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
        window.location.href = '/pulse/shiftment';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>
               
                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='code'>
                        Code  Shiftment
                    </label>
                    <Input
                        type='string'
                        {...register('code')}
                        className='input input-bordered w-full'
                        placeholder='Code  Shiftment'
                    />
                    {errors.code && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.code.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='name'>
                        Shiftment  Name
                    </label>
                    <Input
                        type='string'
                        {...register('name')}
                        className='input input-bordered w-full'
                        placeholder='Shiftment  Name'
                    />
                    {errors.name && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.name.message}
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
