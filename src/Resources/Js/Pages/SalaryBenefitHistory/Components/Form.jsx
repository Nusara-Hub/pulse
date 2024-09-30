import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';

const schema = z.object({
    'employee_id': z.string().nonempty(),
'sallary_component_id': z.string().nonempty(),
'contract_id': z.string().nonempty(),
'new_benefit_value': z.number()
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
        window.location.href = '/pulse/salary-benefit-history';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>
               
                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='employee_id'>
                        Employee
                    </label>
                    <Input
                        type='string'
                        {...register('employee_id')}
                        className='input input-bordered w-full'
                        placeholder='Employee'
                    />
                    {errors.employee_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.employee_id.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='sallary_component_id'>
                        Component
                    </label>
                    <Input
                        type='string'
                        {...register('sallary_component_id')}
                        className='input input-bordered w-full'
                        placeholder='Component'
                    />
                    {errors.sallary_component_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.sallary_component_id.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='contract_id'>
                        Contract
                    </label>
                    <Input
                        type='string'
                        {...register('contract_id')}
                        className='input input-bordered w-full'
                        placeholder='Contract'
                    />
                    {errors.contract_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.contract_id.message}
                        </p>
                    )}
                </div>
            

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='new_benefit_value'>
                        Benefit  Value
                    </label>
                    <Input
                        type='number'
                        {...register('new_benefit_value')}
                        className='input input-bordered w-full'
                        placeholder='Benefit  Value'
                    />
                    {errors.new_benefit_value && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.new_benefit_value.message}
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
