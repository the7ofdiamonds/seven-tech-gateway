import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidEmail } from '../utils/Validation';

const apiUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/forgot-password" : "/wp-json/seven-tech/v1/users/forgot-password";

const initialState = {
    forgotLoading: false,
    forgotError: '',
    forgotSuccessMessage: '',
    forgotErrorMessage: ''
};

export const forgot = createAsyncThunk( async (email) => {
    try {


        if (isValidEmail(email)) {
            var email = identity;
        }

        const response = await fetch(`${apiUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "email": email
            })
        });

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const forgotSlice = createSlice({
    name: 'forgot',
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addCase(updateforgot.fulfilled, (state, action) => {
                state.forgotLoading = false;
                state.forgotError = '';
                state.forgotSuccessMessage = action.payload.successMessage;
                state.forgotErrorMessage = action.payload.errorMessage;
            })
            .addMatcher(isAnyOf(
                updateforgot.pending,
            ), (state) => {
                state.forgotLoading = true;
                state.forgotError = null;
                state.forgotSuccessMessage = null;
                state.forgotErrorMessage = null;
            })
            .addMatcher(isAnyOf(
                updateforgot.rejected,
            ),
                (state, action) => {
                    state.forgotLoading = false;
                    state.forgotError = action.error;
                    state.forgotErrorMessage = action.error;
                });
    }
})

export default forgotSlice;

