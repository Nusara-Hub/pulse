import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import SelectSearch from "@/components/SelectSearch";
import { Skeleton } from "@/components/ui/skeleton"

const schema = z.object({
    'code': z.string().nonempty(),
    'name': z.string().nonempty(),
    'state': z.string().nonempty(),
    'is_fixed': z.boolean()
});

const Form = ({ id, onSubmit, initialData = {} }) => {
    const dataType = [
        { name: 'Income', id: 'Income' },
        { name: 'Deductions', id: 'Deductions' }
    ];
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
    }, [id, reset, initialData]);

    const handleCancel = () => {
        window.location.href = '/pulse/salary-component';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>
                <div className="grid grid-cols-2 gap-4 mb-4">
                    <div className='mb-4'>
                        <label className='block text-sm font-bold mb-2' htmlFor='code'>
                            Salary  Component  Code
                        </label>
                        <Input
                            type='string'
                            {...register('code')}
                            className='input input-bordered w-full'
                            placeholder='Salary  Component  Code'
                        />
                        {errors.code && (
                            <p className='text-red-500 text-xs italic'>
                                {errors.code.message}
                            </p>
                        )}
                    </div>


                    <div className='mb-4'>
                        <label className='block text-sm font-bold mb-2' htmlFor='name'>
                            Component  Name
                        </label>
                        <Input
                            type='string'
                            {...register('name')}
                            className='input input-bordered w-full'
                            placeholder='Component  Name'
                        />
                        {errors.name && (
                            <p className='text-red-500 text-xs italic'>
                                {errors.name.message}
                            </p>
                        )}
                    </div>


                    <div className='mb-4'>
                        <label className='block text-sm font-bold mb-2' htmlFor='state'>
                            Type
                        </label>
                        <SelectSearch
                            data={dataType || []}
                            initialValue={initialData.data?.state || ''}
                            onChange={value => setValue('state', value)}
                            value='id'
                            label='name'
                            placeholder='Type'
                        />
                        {errors.state && (
                            <p className='text-red-500 text-xs italic'>
                                {errors.state.message}
                            </p>
                        )}
                    </div>


                    <div className='mb-4'>
                        <label className='block text-sm font-bold mb-2' htmlFor='is_fixed'>
                            Fixed
                        </label>
                        <input
                            type='checkbox'
                            {...register('is_fixed')}
                            className='checkbox checkbox-bordered'
                        />
                        {errors.is_fixed && (
                            <p className='text-red-500 text-xs italic'>
                                {errors.is_fixed.message}
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
