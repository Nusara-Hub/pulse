import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import SelectSearch from "@/components/SelectSearch";
import { Skeleton } from "@/components/ui/skeleton"
const schema = z.object({
    'employee_id': z.string().nonempty(),
    'sallary_component_id': z.string().nonempty(),
    'benefit_value': z.string().transform((val) => parseFloat(val)).refine((val) => !isNaN(val), {
        message: "Amount must be a valid number"
    })
});

import { useSalaryComponentStore } from '../../SalaryComponent/State/useSalaryComponentStore';
import { useEmployeeStore } from '../../Employee/State/useEmployeeStore';
const Form = ({ id, onSubmit, initialData = {} }) => {
    const { fetch: employee, datas: dataEmployee = [], loading: loadingEmployee } = useEmployeeStore();
    const { fetch: sallaryComponent, datas: dataSallaryComponent = [], loading: loadingSalaryComponent } = useSalaryComponentStore();
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
        sallaryComponent(true);
        employee();
    }, [id, reset, initialData]);

    const handleCancel = () => {
        window.location.href = '/pulse/salary-benefit';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>

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


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='sallary_component_id'>
                        Component  Salary
                    </label>
                    {loadingSalaryComponent ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                        data={dataSallaryComponent.data?.filter((item) => item.state == 'Income') || []}
                        initialValue={initialData.data?.sallary_component_id || ''}
                        onChange={(value) => setValue('sallary_component_id', value)}
                        value='id'
                        label='name'
                        placeholder='Component Salary'
                    />}
                    {errors.sallary_component_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.sallary_component_id.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='benefit_value'>
                        Benefit  Value
                    </label>
                    <Input
                        type='number'
                        {...register('benefit_value')}
                        className='input input-bordered w-full'
                        placeholder='Benefit  Value'
                    />
                    {errors.benefit_value && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.benefit_value.message}
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
