import React, { useEffect, useState } from 'react';
import { Button } from "@/Components/ui/button";
import { Input } from "@/components/ui/input";
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import { Select, SelectTrigger, SelectContent, SelectItem, SelectValue, SelectGroup, SelectLabel } from "@/components/ui/select";

const schema = z.object({
    'region_id': z.string().nonempty(),
    'code': z.string().nonempty(),
    'name': z.string().nonempty()
});

const Form = ({ id, onSubmit, initialData = {}, region }) => {
    const {
        register,
        handleSubmit,
        reset,
        formState: { errors },
        setValue,
    } = useForm({
        resolver: zodResolver(schema),
    });

    const [searchQuery, setSearchQuery] = useState(''); // Manage the search input
    const [filteredRegions, setFilteredRegions] = useState(region); // Manage the filtered list of regions

    useEffect(() => {
        reset(initialData.data);
    }, [id, reset, initialData]);

    useEffect(() => {
        // Filter regions based on search query
        setFilteredRegions(
            region.filter(r =>
                r.name.toLowerCase().includes(searchQuery.toLowerCase())
            )
        );
    }, [searchQuery, region]);

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
                    <Select
                        onValueChange={(value) => setValue('region_id', value)}
                        defaultValue={initialData.data?.region_id || ''}
                    >
                        <SelectTrigger className='input input-bordered w-full'>
                            <SelectValue placeholder="Select a region" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectLabel>Regions</SelectLabel>
                                <Input
                                    className='input input-bordered w-full mb-2'
                                    placeholder='Search region...'
                                    value={searchQuery}
                                    onChange={(e) => setSearchQuery(e.target.value)}
                                />
                                {filteredRegions.length ? (
                                    filteredRegions.map((r) => (
                                        <SelectItem key={r.id} value={r.id}>
                                            {r.name}
                                        </SelectItem>
                                    ))
                                ) : (
                                    <p className='text-gray-500 text-xs italic'>No regions found</p>
                                )}
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                    {errors.region_id && (
                        <p className='text-red-500 text-xs italic'>
                            {errors.region_id.message}
                        </p>
                    )}
                </div>

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
