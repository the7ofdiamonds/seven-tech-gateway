import axios from 'axios';
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
    loading: false,
    error: '',
    team: ''
};

export const getTeam = createAsyncThunk('team/getTeam', async () => {

    try {
        const response = await fetch(`/wp-json/thfw/users/v1/team`, {
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
        console.log(error)
        throw error.message;
    }
});

export const clientSlice = createSlice({
    name: 'team',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(getTeam.pending, (state) => {
                state.loading = true
                state.error = null
            })
            .addCase(getTeam.fulfilled, (state, action) => {
                state.loading = false;
                state.error = null;
                state.team = action.payload
            })
            .addCase(getTeam.rejected, (state, action) => {
                state.loading = false
                state.error = action.error.message
            })
    }
})

export default clientSlice;