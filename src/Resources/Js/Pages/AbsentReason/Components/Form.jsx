import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';

const schema = z.object({
    'type': z.string().nonempty(),
'code': z.string().nonempty(),
'reason': z.string().nonempty()
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
        window.location.href = '/pulse/absent-reason';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>
               
                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='type'>
                        Type  Reason
                    </label>
                    <Input
                        type='string'
                        {...register('type')}
                        className='input input-bordered w-full'
                        placeholder='Type  Reason'
                    />
                    {errors.type && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.type.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='code'>
                        Reason  Code
                    </label>
                    <Input
                        type='string'
                        {...register('code')}
                        className='input input-bordered w-full'
                        placeholder='Reason  Code'
                    />
                    {errors.code && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.code.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='reason'>
                        Reason  Name
                    </label>
                    <Input
                        type='string'
                        {...register('reason')}
                        className='input input-bordered w-full'
                        placeholder='Reason  Name'
                    />
                    {errors.reason && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.reason.message}
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
