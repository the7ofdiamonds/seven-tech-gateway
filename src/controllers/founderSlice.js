import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
    founderLoading: false,
    founderError: '',
    founders: '',
    title: '',
    avatarURL: '',
    authorURL: '',
    fullName: '',
    greeting: '',
    skills: '',
    founderResume: ''
};

export const getFounders = createAsyncThunk('founder/getFounders', async () => {

    try {
        const response = await fetch(`/wp-json/seven-tech/v1/users/founders`, {
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

export const getFounder = createAsyncThunk('founder/getFounder', async (founder) => {

    try {
        const response = await fetch(`/wp-json/seven-tech/v1/users/founder/${founder}`, {
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

export const getFounderResume = createAsyncThunk('founder/getFounderResume', async (pageTitle) => {

    try {
        const response = await fetch(`/wp-json/seven-tech/v1/users/founder/${pageTitle}/resume`, {
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
                state.founderLoading = false
                state.founderError = null
                state.title = action.payload.title
                state.authorURL = action.payload.author_url
                state.avatarURL = action.payload.avatar_url
                state.fullName = action.payload.fullName
                state.greeting = action.payload.greeting
                state.skills = action.payload.skills
                state.founderResume = action.payload.founderResume
            })
            .addCase(getFounder.rejected, (state, action) => {
                state.founderLoading = false
                state.founderError = action.error.message
            })
            .addCase(getFounderResume.pending, (state) => {
                state.founderLoading = true
                state.founderError = ''
            })
            .addCase(getFounderResume.fulfilled, (state, action) => {
                state.founderLoading = false;
                state.founderError = null;
                state.founderResume = action.payload
            })
            .addCase(getFounderResume.rejected, (state, action) => {
                state.founderLoading = false
                state.founderError = action.error.message
            })

    }
})

export default founderSlice;