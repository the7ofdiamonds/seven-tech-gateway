import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const apiUrl = "/wp-json/seven-tech/v1/users/token";

const initialState = {
    tokenLoading: false,
    tokenError: '',
    tokenSuccessMessage: '',
    tokenErrorMessage: '',
};

export const token = createAsyncThunk('token/token', async () => {
    try {

        const response = await fetch(`${apiUrl}/`, {
            method: 'POST',
            headers: {
                'Authentication': "Bearer " + localStorage.getItem('access_token'),
                'refresh-token': localStorage.getItem('refresh_token'),
                'Content-Type': 'application/json'
            }
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
            })
            .addMatcher(isAnyOf(
                token.pending,
            ), (state) => {
                state.tokenLoading = true;
                state.tokenError = null;
                state.tokenSuccessMessage = null;
                state.tokenErrorMessage = null;
            })
            .addMatcher(isAnyOf(
                token.rejected,
            ),
                (state, action) => {
                    state.tokenLoading = false;
                    state.tokenError = action.error;
                    state.tokenErrorMessage = action.error.message;
                });
    }
})

export default tokenSlice;