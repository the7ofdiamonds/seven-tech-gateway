import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const apiUrl = "/wp-json/seven-tech/v1/users/token";

const initialState = {
    tokenLoading: false,
    tokenError: '',
    tokenSuccessMessage: '',
    tokenErrorMessage: '',
    tokenStatusCode: ''
};

export const token = createAsyncThunk('token/token', async (location) => {
    try {
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        const response = await fetch(`${apiUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                location: {
                    longitude: location.longitude,
                    latitude: location.latitude
                }
            })
        });

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const tokenSlice = createSlice({
    name: 'token',
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addCase(token.fulfilled, (state, action) => {
                state.tokenLoading = false;
                state.tokenError = '';
                state.tokenSuccessMessage = action.payload.successMessage;
                state.tokenErrorMessage = action.payload.errorMessage;
                state.tokenStatusCode = action.payload.statusCode;
            })
            .addMatcher(isAnyOf(
                token.pending,
            ), (state) => {
                state.tokenLoading = true;
                state.tokenError = '';
                state.tokenSuccessMessage = '';
                state.tokenErrorMessage = '';
                state.tokenStatusCode = '';

            })
            .addMatcher(isAnyOf(
                token.rejected,
            ),
                (state, action) => {
                    state.tokenLoading = false;
                    state.tokenError = action.error;
                    state.tokenErrorMessage = action.error.message;
                    state.tokenStatusCode = action.error.statusCode;
                });
    }
})

export default tokenSlice;