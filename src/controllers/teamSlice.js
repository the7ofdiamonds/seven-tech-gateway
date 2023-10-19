import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
    teamLoading: false,
    teamError: '',
    team: ''
};

export const getTeam = createAsyncThunk('team/getTeam', async () => {

    try {
        const response = await fetch(`/wp-json/seven-tech/users/v1/team`, {
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

export const teamSlice = createSlice({
    name: 'team',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(getTeam.pending, (state) => {
                state.teamLoading = true
                state.teamError = ''
            })
            .addCase(getTeam.fulfilled, (state, action) => {
                state.teamLoading = false;
                state.teamError = null;
                state.team = action.payload
            })
            .addCase(getTeam.rejected, (state, action) => {
                state.teamLoading = false
                state.teamError = action.error.message
            })
    }
})

export default teamSlice;