import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const logoutUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/logout" : "/wp-json/seven-tech/v1/users/logout";
export const logoutAllUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/logout-all" : null;

const initialState = {
    logoutLoading: false,
    logoutError: '',
    logoutSuccessMessage: '',
    logoutErrorMessage: ''
};

export const logout = createAsyncThunk('logout/logout', async () => {
    try {
        const email = localStorage.getItem('email');

        const response = await fetch(logoutUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "email": email
            })
        });

        if (!response.ok) {
            const errorData = await response.json();
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

        const responseData = await response.json();

        localStorage.removeItem('display_name');
        localStorage.removeItem('email');
        localStorage.removeItem('access_token');
        localStorage.removeItem('refresh_token');

        return responseData;
    } catch (error) {
        console.error('Error:', error.message);
    }
});

export const logoutAll = createAsyncThunk('logout/logoutAll', async () => {
    try {
        const email = localStorage.getItem('email');

        const response = await fetch(logoutAllUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "email": email,
            })
        });

        if (!response.ok) {
            const errorData = await response.json();
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

        const responseData = await response.json();

        localStorage.removeItem('display_name');
        localStorage.removeItem('email');
        localStorage.removeItem('access_token');
        localStorage.removeItem('refresh_token');

        return responseData;
    } catch (error) {
        console.error('Error:', error.message);
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
            })
            .addCase(logoutAll.fulfilled, (state, action) => {
                state.logoutLoading = false;
                state.logoutError = '';
                state.logoutSuccessMessage = action.payload.successMessage;
                state.logoutErrorMessage = action.payload.errorMessage;
            })
            .addMatcher(isAnyOf(
                logout.pending,
                logoutAll.pending
            ), (state) => {
                state.logoutLoading = true;
                state.logoutError = null;
                state.logoutSuccessMessage = null;
                state.logoutErrorMessage = null;
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