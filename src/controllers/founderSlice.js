import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
    founderLoading: false,
    founderError: '',
    founders: '',
    founder: ''
};

export const getFounders = createAsyncThunk('founder/getFounders', async () => {

    try {
        const response = await fetch(`/wp-json/seven-tech/users/v1/founders`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });

        if (!response.ok) {
            const errorData = await response.json();
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        throw error;
    }
});

export const getFounder = createAsyncThunk('founder/getFounder', async () => {

    try {
        const response = await fetch(`/wp-json/seven-tech/users/v1/founder`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });

        if (!response.ok) {
            const errorData = await response.json();
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        throw error;
    }
});

export const founderSlice = createSlice({
    name: 'founder',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(getFounders.pending, (state) => {
                state.founderLoading = true
                state.founderError = ''
            })
            .addCase(getFounders.fulfilled, (state, action) => {
                state.founderLoading = false;
                state.founderError = null;
                state.founders = action.payload
            })
            .addCase(getFounders.rejected, (state, action) => {
                state.founderLoading = false
                state.founderError = action.error.message
            })
            .addCase(getFounder.pending, (state) => {
                state.founderLoading = true
                state.founderError = ''
            })
            .addCase(getFounder.fulfilled, (state, action) => {
                state.founderLoading = false;
                state.founderError = null;
                state.founder = action.payload
            })
            .addCase(getFounder.rejected, (state, action) => {
                state.founderLoading = false
                state.founderError = action.error.message
            })

    }
})

export default founderSlice;