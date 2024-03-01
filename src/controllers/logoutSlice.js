import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import {
    browserSessionPersistence,
    getAuth,
    setPersistence,
    signOut,
} from 'firebase/auth';
import { firebaseAuth } from '../services/firebase/config.js';

const apiUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL : "/wp-json/seven-tech/v1/users/logout";

const initialState = {
    logoutLoading: false,
    logoutError: '',
    logoutMessage: '',
    logoutMessageType: '',
    user_logout: '',
    display_name: localStorage.getItem('display_name'),
    user_pass: '',
    user_email: '',
    first_name: '',
    last_name: '',
    user_id: '',
    accessToken: localStorage.getItem('access_token'),
    refreshToken: localStorage.getItem('refresh_token'),
    customToken: ''
};

export const logout = createAsyncThunk('logout/logout', async () => {
    try {
        const response = await fetch('/wp-json/seven-tech/v1/users/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": localStorage.getItem('display_name'),
            })
        });

        if (!response.ok) {
            const errorData = await response.json();
            console.error(errorData);
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

        const responseData = await response.json();
        console.log(responseData);
        return responseData;
    } catch (error) {
        console.error('Error:', error.message);
    }
});

export const signout = createAsyncThunk('logout/signout', async () => {
    try {
        const firebaseAuth = getAuth();

        return signOut(firebaseAuth).then(() => {
            localStorage.removeItem('display_name');
            localStorage.removeItem('access_token');
            localStorage.removeItem('refresh_token');
        });
    } catch (error) {
        console.error(error)
        throw error;
    }
})

export const logoutSlice = createSlice({
    name: 'logout',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(logout.fulfilled, (state, action) => {
                state.logoutLoading = false;
                state.logoutError = '';
                state.logoutMessage = action.payload.message;
                state.logoutMessageType = action.payload.message_type;
            })
            .addCase(signout.fulfilled, (state) => {
                state.logoutLoading = false;
                state.logoutError = '';
                state.logoutMessage = 'Signout successful';
                state.logoutMessageType = 'success';
            })
            .addMatcher(isAnyOf(
                logout.pending,
                signout.pending
            ), (state) => {
                state.logoutLoading = true;
                state.logoutError = null;
            })
            .addMatcher(isAnyOf(
                logout.rejected,
                signout.rejected
            ),
                (state, action) => {
                    state.logoutLoading = false;
                    state.logoutError = action.error.stack;
                    state.logoutMessageType = 'error';
                    state.logoutMessage = action.error.message;
                });
    }
})

export default logoutSlice;