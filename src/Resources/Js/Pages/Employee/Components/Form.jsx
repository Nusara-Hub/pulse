import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';

const schema = z.object({
    'code': z.string().nonempty(),
    'fullname': z.string().nonempty(),
    'gender': z.string().nonempty(),
    'place_of_birth': z.string().nonempty(),
    'date_of_birth': z.date(),
    'identity_type': z.string().nonempty(),
    'identity_number': z.string().nonempty(),
    'martial_status': z.string().nonempty(),
    'join_date': z.date(),
    'profile_image': z.string().nonempty(),
    'employee_status': z.string().nonempty(),
    'contract_id': z.string().nonempty(),
    'department_id': z.string().nonempty(),
    'job_level_id': z.string().nonempty(),
    'job_title_id': z.string().nonempty(),
    'supervisor_id': z.string(),
    'risk_ratio': z.string().nonempty()
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
        window.location.href = '/pulse/employee';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='code'>
                        Employee  Code
                    </label>
                    <Input
                        type='string'
                        {...register('code')}
                        className='input input-bordered w-full'
                        placeholder='Employee  Code'
                    />
                    {errors.code && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.code.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='fullname'>
                        Name
                    </label>
                    <Input
                        type='string'
                        {...register('fullname')}
                        className='input input-bordered w-full'
                        placeholder='Name'
                    />
                    {errors.fullname && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.fullname.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='gender'>
                        Gender
                    </label>
                    <Input
                        type='string'
                        {...register('gender')}
                        className='input input-bordered w-full'
                        placeholder='Gender'
                    />
                    {errors.gender && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.gender.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='place_of_birth'>
                        Place of  Birth
                    </label>
                    <Input
                        type='string'
                        {...register('place_of_birth')}
                        className='input input-bordered w-full'
                        placeholder='Place of  Birth'
                    />
                    {errors.place_of_birth && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.place_of_birth.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='date_of_birth'>
                        Date of  Birth
                    </label>
                    <Input
                        type='date'
                        {...register('date_of_birth')}
                        className='input input-bordered w-full'
                        placeholder='Date of  Birth'
                    />
                    {errors.date_of_birth && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.date_of_birth.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='identity_type'>
                        Identity  Type
                    </label>
                    <Input
                        type='string'
                        {...register('identity_type')}
                        className='input input-bordered w-full'
                        placeholder='Identity  Type'
                    />
                    {errors.identity_type && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.identity_type.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='identity_number'>
                        Identity  Number
                    </label>
                    <Input
                        type='string'
                        {...register('identity_number')}
                        className='input input-bordered w-full'
                        placeholder='Identity  Number'
                    />
                    {errors.identity_number && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.identity_number.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='martial_status'>
                        Martial  Status
                    </label>
                    <Input
                        type='string'
                        {...register('martial_status')}
                        className='input input-bordered w-full'
                        placeholder='Martial  Status'
                    />
                    {errors.martial_status && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.martial_status.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='join_date'>
                        Join  Date
                    </label>
                    <Input
                        type='date'
                        {...register('join_date')}
                        className='input input-bordered w-full'
                        placeholder='Join  Date'
                    />
                    {errors.join_date && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.join_date.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='profile_image'>
                        Profile  Picture
                    </label>
                    <Input
                        type='string'
                        {...register('profile_image')}
                        className='input input-bordered w-full'
                        placeholder='Profile  Picture'
                    />
                    {errors.profile_image && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.profile_image.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='employee_status'>
                        Employee  Status
                    </label>
                    <Input
                        type='string'
                        {...register('employee_status')}
                        className='input input-bordered w-full'
                        placeholder='Employee  Status'
                    />
                    {errors.employee_status && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.employee_status.message}
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
                    <label className='block text-sm font-bold mb-2' htmlFor='department_id'>
                        Department
                    </label>
                    <Input
                        type='string'
                        {...register('department_id')}
                        className='input input-bordered w-full'
                        placeholder='Department'
                    />
                    {errors.department_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.department_id.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='job_level_id'>
                        Job  Level
                    </label>
                    <Input
                        type='string'
                        {...register('job_level_id')}
                        className='input input-bordered w-full'
                        placeholder='Job  Level'
                    />
                    {errors.job_level_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.job_level_id.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='job_title_id'>
                        Job  Title
                    </label>
                    <Input
                        type='string'
                        {...register('job_title_id')}
                        className='input input-bordered w-full'
                        placeholder='Job  Title'
                    />
                    {errors.job_title_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.job_title_id.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='supervisor_id'>
                        Supervisor
                    </label>
                    <Input
                        type='string'
                        {...register('supervisor_id')}
                        className='input input-bordered w-full'
                        placeholder='Supervisor'
                    />
                    {errors.supervisor_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.supervisor_id.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='risk_ratio'>
                        Risk  Ration
                    </label>
                    <Input
                        type='string'
                        {...register('risk_ratio')}
                        className='input input-bordered w-full'
                        placeholder='Risk  Ration'
                    />
                    {errors.risk_ratio && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.risk_ratio.message}
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
