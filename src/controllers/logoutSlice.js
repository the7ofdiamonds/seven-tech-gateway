import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidEmail } from '../utils/Validation';

const logoutUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/logout" : "/wp-json/seven-tech/v1/users/logout";
export const logoutAllUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/logout-all" : null;

const initialState = {
    logoutLoading: false,
    logoutError: '',
    logoutSuccessMessage: '',
    logoutErrorMessage: '',
    logoutStatusCode: ''
};

export const logout = createAsyncThunk('logout/logout', async () => {
    try {
        const email = localStorage.getItem('email');

        if (isValidEmail(email) == false) {
            throw new Error('Email is not valid.');
        }

        const response = await fetch(logoutUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email
            })
        });

        const responseData = await response.json();

        localStorage.removeItem('display_name');
        localStorage.removeItem('email');
        localStorage.removeItem('access_token');
        localStorage.removeItem('refresh_token');

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const logoutAll = createAsyncThunk('logout/logoutAll', async () => {
    try {
        const email = localStorage.getItem('email');

        if (isValidEmail(email) == false) {
            throw new Error('Email is not valid.');
        }

        const response = await fetch(logoutAllUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
            })
        });

        const responseData = await response.json();

        localStorage.removeItem('display_name');
        localStorage.removeItem('email');
        localStorage.removeItem('access_token');
        localStorage.removeItem('refresh_token');

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const logoutSlice = createSlice({
    name: 'logout',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(logout.fulfilled, (state, action) => {
                state.logoutLoading = false;
                state.logoutError = '';
                state.logoutSuccessMessage = action.payload.successMessage;
                state.logoutErrorMessage = action.payload.errorMessage;
                state.logoutStatusCode = action.payload.statusCode;
            })
            .addCase(logoutAll.fulfilled, (state, action) => {
                state.logoutLoading = false;
                state.logoutError = '';
                state.logoutSuccessMessage = action.payload.successMessage;
                state.logoutErrorMessage = action.payload.errorMessage;
                state.logoutStatusCode = action.payload.statusCode;
            })
            .addMatcher(isAnyOf(
                logout.pending,
                logoutAll.pending
            ), (state) => {
                state.logoutLoading = true;
                state.logoutError = '';
                state.logoutSuccessMessage = '';
                state.logoutErrorMessage = '';
                state.logoutStatusCode = '';

            })
            .addMatcher(isAnyOf(
                logout.rejected,
                logoutAll.rejected
            ),
                (state, action) => {
                    state.logoutLoading = false;
                    state.logoutError = action.error;
                    state.logoutErrorMessage = action.error.message;
                });
    }
})

export default logoutSlice;