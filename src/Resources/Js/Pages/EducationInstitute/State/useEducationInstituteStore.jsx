import { create } from 'zustand';
import { getData, createData, updateData, deleteData, showData, exportData } from '../Services/EducationInstituteService';

export const useEducationInstituteStore = create((set, get) => ({
    edu: [],
    detail: [],
    page: 1,
    limit: 10,
    search: '',
    pagination: {
        total_data: 0,
        total_filtered: 0,
        current_page: 1,
        total_pages: 1,
        previous_page: null,
        next_page: null
    },
    loading: false,
    error: null,

    // Actions
    fetchEducation: async () => {
        const { page, limit, search } = get();
        set({ loading: true });
        try {
            const data = await getData(page, limit, search);
            set({
                edu: data,
                pagination: data.pagination,
                loading: false
            });
        } catch (error) {
            console.error('Error fetching data:', error);
            set({ loading: false, error });
        }
    },

    showEducation: async (id) => {
        try {
            const data = await showData(id);
            set({ detail: data });
        } catch (error) {
            console.error('Error fetching details:', error);
        }
    },

    handleInsert: async (newData) => {
        if (newData) {
            try {
                await createData(newData);
                get().fetchEducation(); // Refresh data
            } catch (error) {
                console.error('Error inserting data:', error);
                throw error;
            }
        }
    },

    handleUpdate: async (id, updateData) => {
        if (updateData) {
            try {
                await updateData(id, updateData);
                get().fetchEducation(); // Refresh data
            } catch (error) {
                console.error('Error updating data:', error);
                throw error;
            }
        }
    },

    handleDelete: async (id) => {
        if (id) {
            try {
                await deleteData(id);
                get().fetchEducation(); // Refresh data
            } catch (error) {
                console.error('Error deleting data:', error);
                throw error;
            }
        }
    },

    handleExport: async () => {
        try {
            const res = await exportData();
            console.log(res);
            return res;
        } catch (error) {
            console.error('Error exporting data:', error);
            throw error;
        }
    },

    setSearch: (newSearch) => set((state) => ({
        ...state,
        search: newSearch,
    })),

    setLimit: (newLimit) => {
        console.log("Limit");
        set({ limit: newLimit, page: 1 }); // Reset to first page when limit changes
        get().fetchEducation();
    },

    setPage: (newPage) => {
        set({ page: newPage });
        get().fetchEducation();
    },

    handleNextPage: () => {
        const { page, pagination } = get();
        if (page < pagination.total_pages) {
            set({ page: page + 1 });
            get().fetchEducation();
        }
    },

    handlePreviousPage: () => {
        const { page } = get();
        if (page > 1) {
            set({ page: page - 1 });
            get().fetchEducation();
        }

    },
    handleSearchChange(newSearch) {
        set({ search: newSearch, page: 1 });
        get().fetchEducation(); // Trigger fetch after updating the state
    }
}));
