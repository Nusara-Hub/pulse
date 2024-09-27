import React, { useEffect } from 'react';
import { Button } from "@/Components/ui/button"
import { Input } from "@/components/ui/input"
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import { Select, SelectTrigger, SelectContent, SelectItem, SelectValue, SelectGroup, SelectLabel } from "@/components/ui/select";
const schema = z.object({
    'parent_id': z.string().nullable().optional(),
    'name': z.string().nonempty()
});
import { useSkillGroupStore } from '../State/useSkillGroupStore';
import { Skeleton } from "@/components/ui/skeleton"
import SelectSearch from "@/components/SelectSearch";

const Form = ({ id, onSubmit, initialData = {} }) => {
    const { fetch, datas = [], loading } = useSkillGroupStore();
    const {
        register,
        handleSubmit,
        reset,
        formState: { errors },
        setValue, // Destructure setValue from useForm
    } = useForm({
        resolver: zodResolver(schema),
    });

    useEffect(() => {
        fetch();
        reset(initialData.data);
    }, [id, reset, initialData]);

    const handleCancel = () => {
        window.location.href = '/pulse/skill-group';
    };

    return (
        <>
            <form className="bg-white rounded-md border mx-4 px-8 pt-6 pb-8 mb-4" onSubmit={handleSubmit(onSubmit)}>

                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='parent_id'>
                        Skill Parent
                    </label>
                    {loading ? <Skeleton className="h-4 w-[250px]" /> : <SelectSearch
                        data={datas.data || []}
                        initialValue={initialData.data?.parent_id || ''} // Use empty string for default value
                        onChange={(value) => setValue('parent_id', value === '' ? null : value)} // Set null when no value is selected
                        value='id'
                        label='name'
                        placeholder='Skill Parent'
                    />}
                    {errors.parent_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.parent_id.message}
                        </p>
                    )}
                </div>


                <div className='mb-4'>
                    <label className='block text-sm font-bold mb-2' htmlFor='name'>
                        Name
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
