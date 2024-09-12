import axios from 'axios';

    export async function getData(page, limit, search) {
        try {
            const response = await axios.get('/api/pulse/education-institute', {
                params: {
                    page: page,
                    limit: limit,
                    search: search
                }
            });
            console.log(response.data);
            return response.data;
        } catch (error) {
            console.error('Failed to fetch users', error);
            throw error;
        }
    }

    export async function showData(id) {
        try {
            console.log('/api/pulse/education-institute/' + id);
            const response = await axios.get('/api/pulse/education-institute/' + id);
            console.log(response.data);
            return response.data;
        } catch (error) {
            console.error('Failed to show data', error);
            throw error;
        }
    }

    export async function createData(data) {
        console.log(data);
        if(data){
        try {
            const response = await axios.post('/api/pulse/education-institute', data);
            return response.data;
        } catch (error) {
            console.error('Failed to create data', error);
            throw error;
        }
        }
    }

    export async function updateData(id, data) {
        console.log(data);
        if(data){
        try {
            const response = await axios.put(`/api/pulse/education-institute/${id}`, data);
            return response.data;
        } catch (error) {
            console.error('Failed to update data', error);
            throw error;
        }
        }
    }

    export async function deleteData(id) {
        try {
            const response = await axios.delete(`/api/pulse/education-institute/${id}`);
            return response.data;
        } catch (error) {
            console.error('Failed to delete data', error);
            throw error;
        }
    }
