import React, { useEffect, useState } from 'react';
import { Button } from "@/Components/ui/button";
import { Input } from "@/components/ui/input";
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import SelectSearch from "@/components/SelectSearch";
const schema = z.object({
    'region_id': z.string().nonempty(),
    'code': z.string().nonempty(),
    'name': z.string().nonempty()
});
import { useRegionStore } from '../../Region/State/useRegionStore';
import { Skeleton } from "@/components/ui/skeleton"

const Form = ({ id, onSubmit, initialData = {}, region }) => {
    const { datas = [], loading, fetch } = useRegionStore(); // Ensure datas is an array
    const {
        register,
        handleSubmit,
        reset,
        formState: { errors },
        setValue,
    } = useForm({
        resolver: zodResolver(schema),
    });

    useEffect(() => {
        fetch();
        reset(initialData.data);
    }, [id, reset, initialData]);

    const handleCancel = () => {
        window.location.href = '/pulse/city';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>
                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='region_id'>
                        Region
                    </label>
                    {loading ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                        data={datas.data || []}
                        initialValue={initialData.data?.region_id || ''}
                        onChange={(value) => setValue('region_id', value)}
                        value='id'
                        label='name'
                        placeholder='Region'
                    />}
                    {errors.region_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.region_id.message}
                        </p>
                    )}
                </div>
                <div className="grid grid-cols-2 gap-4 mb-4">
                    <div className='mb-4'>
                        <label className='block text-sm font-bold mb-2' htmlFor='code'>
                            City Code
                        </label>
                        <Input
                            type='string'
                            {...register('code')}
                            defaultValue={initialData.data?.code || ''}
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
                            City Name
                        </label>
                        <Input
                            type='string'
                            {...register('name')}
                            defaultValue={initialData.data?.name || ''}
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
