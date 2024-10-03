import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import SelectSearch from "@/components/SelectSearch";
import { Skeleton } from "@/components/ui/skeleton"
import { useDepartmentStore } from '../../Department/State/useDepartmentStore';
import { useJobLevelStore } from '../../JobLevel/State/useJobLevelStore';
import { useJobTitleStore } from '../../JobTitle/State/useJobTitleStore';
import { useContractStore } from '../../Contract/State/useContractStore';
import { useEmployeeStore } from '../../Employee/State/useEmployeeStore';
const schema = z.object({
    'employee_id': z.string().nonempty(),
    'department_id': z.string().nonempty(),
    'job_level_id': z.string().nonempty(),
    'job_title_id': z.string().nonempty(),
    'supervisor_id': z.string().optional(),
    'contract_id': z.string().nonempty(),
    'is_active': z.boolean()
});

const Form = ({ id, onSubmit, initialData = {} }) => {
    const { fetch: department, datas: dataDepartment = [], loading: loadingDepartment } = useDepartmentStore();
    const { fetch: joblevel, datas: dataJobLevel = [], loading: loadingJobLevel } = useJobLevelStore();
    const { fetch: jobtitle, datas: dataJobTitle = [], loading: loadingJobTitle } = useJobTitleStore();
    const { fetch: contract, datas: dataContract = [], loading: loadingContract } = useContractStore();
    const { fetch: employee, datas: dataEmployee = [], loading: loadingEmployee } = useEmployeeStore();
    const dataActive = [
        { name: 'Active', id: 'true' },
        { name: 'Non Active', id: 'false' }
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
        department();
        joblevel();
        if (initialData.data?.job_level_id) {
            jobtitle(initialData.data?.job_level_id);
        }
        contract();
        employee();
    }, [id, reset, initialData]);

    const handleCancel = () => {
        window.location.href = '/pulse/placement';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>
                <div className="grid grid-cols-2 gap-4 mb-4">
                    <div>
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
                            <label className='block text-sm font-bold mb-2' htmlFor='department_id'>
                                Department
                            </label>
                            {loadingDepartment ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                                data={dataDepartment.data || []}
                                initialValue={initialData.data?.department_id || ''}
                                onChange={(value) => setValue('department_id', value)}
                                value='id'
                                label='name'
                                placeholder='Department'
                            />}
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
                            {loadingJobLevel ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                                data={dataJobLevel.data || []}
                                initialValue={initialData.data?.job_level_id || ''}
                                onChange={(value) => {
                                    setValue('job_level_id', value);
                                    jobtitle(value);
                                }}
                                value='id'
                                label='name'
                                placeholder='Job Level'
                            />}
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
                            {loadingJobTitle ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                                data={dataJobTitle.data || []}
                                initialValue={initialData.data?.job_title_id || ''}
                                onChange={(value) => setValue('job_title_id', value)}
                                value='id'
                                label='name'
                                placeholder='Job Title'
                            />}
                            {errors.job_title_id && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.job_title_id.message}
                                </p>
                            )}
                        </div>

                    </div>
                    <div>

                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='supervisor_id'>
                                Supervisor
                            </label>
                            {loadingEmployee ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                                data={dataEmployee.data?.filter(emp => emp.id !== initialData.data?.employee_id) || []}
                                initialValue={initialData.data?.supervisor_id || ''}
                                onChange={(value) => setValue('supervisor_id', value)}
                                value='id'
                                label='fullname'
                                placeholder='Supervisor'
                            />}
                            {errors.supervisor_id && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.supervisor_id.message}
                                </p>
                            )}
                        </div>


                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='contract_id'>
                                Contract
                            </label>
                            {loadingContract ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                                data={dataContract.data || []}
                                initialValue={initialData.data?.contract_id || ''}
                                onChange={(value) => setValue('contract_id', value)}
                                value='id'
                                label='letter_number'
                                placeholder='Contract'
                            />}
                            {errors.contract_id && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.contract_id.message}
                                </p>
                            )}
                        </div>


                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='is_active'>
                                Active
                            </label>
                            <SelectSearch
                                data={dataActive || []}
                                initialValue={initialData.data?.is_active ? 'true' : 'false'}
                                onChange={(value) => setValue('is_active', value === 'true')}
                                value='id'
                                label='name'
                                placeholder='Active/Non Active'
                            />
                            {errors.is_active && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.is_active.message}
                                </p>
                            )}
                        </div>
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
