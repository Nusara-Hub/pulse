import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';

const schema = z.object({
    'code': z.string().nonempty(),
    'name': z.string().nonempty()
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
        window.location.href = '/pulse/region/';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>
                <div className="grid grid-cols-2 gap-4 mb-4">
                    <div className='mb-4'>
                        <label className='block text-sm font-bold mb-2' htmlFor='code'>
                            Region Code
                        </label>
                        <Input
                            type='string'
                            {...register('code')}
                            className='input input-bordered w-full'
                            placeholder='code'
                        />
                        {errors.code && (
                            <p className='text-red-500 text-xs italic'>
                                {errors.code.message}
                            </p>
                        )}
                    </div>


                    <div className='mb-4'>
                        <label className='block text-sm font-bold mb-2' htmlFor='name'>
                            Region Name
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
