import axios from 'axios';

export async function getData(page, limit, search) {
    try {
        const response = await axios.get('/api/pulse/overtime', {
            params: {
                page: page,
                limit: limit,
                search: search
            }
        });
        console.log(response.data);
        return response.data;
    } catch (error) {
        console.error('Failed to fetch data', error);
        throw error;
    }
}

export async function showData(id) {
    try {
        const response = await axios.get('/api/pulse/overtime/' + id);
        return response.data;
    } catch (error) {
        console.error('Failed to show data', error);
        throw error;
    }
}

export async function createData(data) {

    if (data) {
        try {
            const response = await axios.post('/api/pulse/overtime', data);
            return response.data;
        } catch (error) {
            console.error('Failed to create data', error);
            throw error;
        }
    }
}

export async function updateData(id, data) {
    if (data) {
        try {
            const response = await axios.put(`/api/pulse/overtime/${id}`, data);
            return response.data;
        } catch (error) {
            console.error('Failed to update data', error);
            throw error;
        }
    }
}

export async function deleteData(id) {
    try {
        const response = await axios.delete(`/api/pulse/overtime/${id}`);
        return response.data;
    } catch (error) {
        console.error('Failed to delete data', error);
        throw error;
    }
}

//add download export

export async function exportData() {
    try {
        const response = await axios.get('/api/pulse/overtime/export', {
            responseType: 'blob', // Ensures binary response
        });

        // Create a URL for the binary file
        const blob = new Blob([response.data], { type: response.headers['content-type'] });
        const url = window.URL.createObjectURL(blob);

        // Create a link element to trigger a download
        const link = document.createElement('a');
        link.href = url;

        // You can set the default file name here
        const filename = response.headers['content-disposition']
            ? response.headers['content-disposition'].split('filename=')[1].replace(/['"]/g, '')
            : 'exported_data.xlsx'; // Default filename

        link.setAttribute('download', filename);  // Set the download attribute with the filename
        document.body.appendChild(link);
        link.click();

        // Clean up the URL and link element after download
        window.URL.revokeObjectURL(url);
        link.remove();
    } catch (error) {
        console.error('Failed to download data', error);
        throw error;
    }
}
