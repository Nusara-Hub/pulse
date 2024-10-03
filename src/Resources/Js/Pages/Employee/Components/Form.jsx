import React, { useEffect, useState } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import Dropzone from 'shadcn-dropzone';
import { DatePicker } from '@/components/ui/datepicker';
import SelectSearch from "@/components/SelectSearch";
import { Skeleton } from "@/components/ui/skeleton"
import { useDepartmentStore } from '../../Department/State/useDepartmentStore';
import { useJobLevelStore } from '../../JobLevel/State/useJobLevelStore';
import { useJobTitleStore } from '../../JobTitle/State/useJobTitleStore';
import { useContractStore } from '../../Contract/State/useContractStore';
import { useEmployeeStore } from '../../Employee/State/useEmployeeStore';
import { useEducationInstituteStore } from '../../EducationInstitute/State/useEducationInstituteStore';
import { useEducationTitleStore } from '../../EducationTitle/State/useEducationTitleStore';
const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
const schema = z.object({
    'code': z.string().nonempty(),
    'fullname': z.string().nonempty(),
    'email': z.string().email(),
    'gender': z.string().nonempty(),
    'place_of_birth': z.string().nonempty(),
    'date_of_birth': z.string().refine((val) => dateRegex.test(val), {
        message: "Invalid date format, must be YYYY-MM-DD"
    }),
    'identity_type': z.string().nonempty(),
    'identity_number': z.string().nonempty(),
    'martial_status': z.string().nonempty(),
    'join_date': z.string().refine((val) => dateRegex.test(val), {
        message: "Invalid date format, must be YYYY-MM-DD"
    }),
    'profile_image': z.any().optional(),
    'employee_status': z.string().nonempty(),
    'contract_id': z.string().nonempty(),
    'department_id': z.string().nonempty(),
    'job_level_id': z.string().nonempty(),
    'job_title_id': z.string().nonempty(),
    'supervisor_id': z.string().nullable().optional(),
    'risk_ratio': z.string().nonempty(),
    'education_institute_id': z.string().nullable().optional(),
    'education_title_id': z.string().nullable().optional(),
});

const Form = ({ id, onSubmit, initialData = {} }) => {
    const [selectedDate, setSelectedDate] = useState(initialData.data?.date_of_birth || null);
    const [selectedJoin, setSelectedJoin] = useState(initialData.data?.join_date || null);
    const { fetch: department, datas: dataDepartment = [], loading: loadingDepartment } = useDepartmentStore();
    const { fetch: joblevel, datas: dataJobLevel = [], loading: loadingJobLevel } = useJobLevelStore();
    const { fetch: jobtitle, datas: dataJobTitle = [], loading: loadingJobTitle } = useJobTitleStore();
    const { fetch: contract, datas: dataContract = [], loading: loadingContract } = useContractStore();
    const { fetch: employee, datas: dataEmployee = [], loading: loadingEmployee } = useEmployeeStore();
    const { fetch: education, datas: dataEducation = [], loading: loadingEducation } = useEducationInstituteStore();
    const { fetch: title, datas: dataTitle = [], loading: loadingTitle } = useEducationTitleStore();
    const dataRisk = [
        { name: 'Very High Risk', id: 'vhr' },
        { name: 'High Risk', id: 'hr' },
        { name: 'Normal Risk', id: 'nr' },
        { name: 'Low Risk', id: 'lr' },
        { name: 'Very Low Risk', id: 'vlr' },
    ];
    const dataGender = [
        { name: 'Male', id: 'M' },
        { name: 'Female', id: 'F' }
    ];
    const dataIdentity = [
        { name: 'Country ID', id: 'Single' },
        { name: 'Passport', id: 'Passport' }
    ];
    const dataMaritalStatus = [
        { name: 'Single', id: 'Single' },
        { name: 'Married', id: 'Married' },
        { name: 'Divorced', id: 'Divorced' },
        { name: 'Widowed', id: 'Widowed' }
    ];

    const dataEmployeeStatus = [
        { name: 'Permanent', id: 'Permanent' },    // Pegawai Tetap
        { name: 'Contract', id: 'Contract' },      // Pegawai Kontrak
        { name: 'Probation', id: 'Probation' },    // Pegawai Percobaan
        { name: 'Intern', id: 'Intern' }           // Pegawai Magang
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
        if (id) {
            const { profile_image, ...filteredData } = initialData.data;
            reset(filteredData);
        } else {
            reset(initialData.data);
        }
        setSelectedDate(initialData.data?.date_of_birth || null);
        setSelectedJoin(initialData.data?.join_date || null);
        education();
        title();
        department();
        joblevel();
        if (initialData.data?.job_level_id) {
            jobtitle(initialData.data?.job_level_id);
        }
        contract();
        employee();
    }, [id, reset, initialData]);

    const handleCancel = () => {
        window.location.href = '/pulse/employee';
    };

    const handleDateSelect = (date) => {
        console.log(date);
        setSelectedDate(date);
        setValue('date_of_birth', date);
    };

    const handleDateJoin = (date) => {
        setSelectedJoin(date);
        setValue('join_date', date);
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>
                <div className="grid grid-cols-2 gap-4 mb-4">
                    <div>
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
                            <label className='block text-sm font-bold mb-2' htmlFor='fullname'>
                                Email
                            </label>
                            <Input
                                type='email'
                                {...register('email')}
                                className='input input-bordered w-full'
                                placeholder='Email'
                            />
                            {errors.email && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.email.message}
                                </p>
                            )}
                        </div>


                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='gender'>
                                Gender
                            </label>
                            <SelectSearch
                                data={dataGender || []}
                                initialValue={initialData.data?.gender || ''}
                                onChange={value => setValue('gender', value)}
                                value='id'
                                label='name'
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
                            <DatePicker
                                initialDate={selectedDate}
                                onSelectDate={handleDateSelect}
                                placeholder="Choose an Date of Birth"
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
                            <SelectSearch
                                data={dataIdentity || []}
                                initialValue={initialData.data?.identity_type || ''}
                                onChange={value => setValue('identity_type', value)}
                                value='id'
                                label='name'
                                placeholder='Identity Type'
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
                            <label className='block text-sm font-bold mb-2' htmlFor='education_institute_id'>
                                Education Institute
                            </label>
                            {loadingEducation ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                                data={dataEducation.data || []}
                                initialValue={initialData.data?.education_institute_id || ''}
                                onChange={(value) => {
                                    console.log(value);
                                    setValue('education_institute_id', value);
                                }}
                                value='id'
                                label='name'
                                placeholder='Education Institute'
                            />}
                            {errors.education_institute_id && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.education_institute_id.message}
                                </p>
                            )}
                        </div>

                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='education_title_id'>
                                Education Title
                            </label>
                            {loadingTitle ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                                data={dataTitle.data || []}
                                initialValue={initialData.data?.education_title_id || ''}
                                onChange={(value) => setValue('education_title_id', value)}
                                value='id'
                                label='name'
                                placeholder='Education Title'
                            />}
                            {errors.education_title_id && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.education_title_id.message}
                                </p>
                            )}
                        </div>


                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='martial_status'>
                                Martial  Status
                            </label>
                            <SelectSearch
                                data={dataMaritalStatus || []}
                                initialValue={initialData.data?.martial_status || ''}
                                onChange={value => setValue('martial_status', value)}
                                value='id'
                                label='name'
                                placeholder='Martial Status'
                            />
                            {errors.martial_status && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.martial_status.message}
                                </p>
                            )}
                        </div>


                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='join_date'>
                                Join Date
                            </label>
                            <DatePicker
                                initialDate={selectedJoin}
                                onSelectDate={handleDateJoin}
                                placeholder="Choose an Join Date"
                            />
                            {errors.join_date && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.join_date.message}
                                </p>
                            )}
                        </div>
                    </div>

                    <div>
                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='profile_image'>
                                Profile Picture
                            </label>

                            <Dropzone
                                onDrop={(files) => {
                                    setValue('profile_image', files);
                                }}
                            >
                                {(dropzone) => (
                                    <div className='h-[100px] items-center justify-center mt-10'>
                                        {
                                            dropzone.isDragAccept ? (
                                                <div className='text-sm font-medium'>Drop your files here!</div>
                                            ) : (
                                                <div className='flex items-center flex-col gap-1.5 '>
                                                    <div className='flex items-center flex-row gap-0.5 text-sm font-medium'>
                                                        Upload files
                                                    </div>
                                                </div>
                                            )
                                        }
                                        <div className='text-xs text-gray-400 font-medium'>
                                            {dropzone.acceptedFiles.length} files uploaded so far.
                                        </div>
                                    </div>
                                )}
                            </Dropzone>
                            {errors.profile_image && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.profile_image.message}
                                </p>
                            )}
                        </div>


                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='employee_status'>
                                Employee Status
                            </label>
                            <SelectSearch
                                data={dataEmployeeStatus || []}
                                initialValue={initialData.data?.employee_status || ''}
                                onChange={value => setValue('employee_status', value)}
                                value='id'
                                label='name'
                                placeholder='Employee Status'
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


                        <div className='mb-4'>
                            <label className='block text-sm font-bold mb-2' htmlFor='supervisor_id'>
                                Supervisor
                            </label>
                            {loadingEmployee ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                                data={dataEmployee.data?.filter(emp => emp.id !== initialData.data?.id) || []}
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
                            <label className='block text-sm font-bold mb-2' htmlFor='risk_ratio'>
                                Risk  Ration
                            </label>
                            <SelectSearch
                                data={dataRisk || []}
                                initialValue={initialData.data?.risk_ratio || ''}
                                onChange={value => setValue('risk_ratio', value)}
                                value='id'
                                label='name'
                                placeholder='Risk Ratio'
                            />
                            {errors.risk_ratio && (
                                <p className='text-red-500 text-xs italic'>
                                    {errors.risk_ratio.message}
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
