import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

import {
    browserSessionPersistence,
    setPersistence,
} from 'firebase/auth';
import { firebaseAuth } from '../services/firebase/config.js';

const initialState = {
    loginLoading: false,
    loginError: '',
    loginMessage: '',
    user_login: '',
    user_pass: '',
    user_email: '',
    first_name: '',
    last_name: '',
    user_id: ''
};

export const signIn = createAsyncThunk('login/signIn', async () => {
    try {
        setPersistence(firebaseAuth, browserSessionPersistence);

        const user = firebaseAuth.currentUser;
        const { email } = user;

        if (!user) {
            throw new Error('User is not currently signed in.', 401);
        }

        sessionStorage.setItem('email', email);

        const token = await user.getIdToken();

        const response = await fetch('/wp-json/seven-tech/v1/users/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ idToken: token })
        });

        if (!response.ok) {
            const errorData = await response.json();
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const loginSlice = createSlice({
    name: 'login',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(signIn.fulfilled, (state, action) => {
                state.loginLoading = false;
                state.loginError = '';
                state.loginMessage = action.payload;
            })
            .addMatcher(isAnyOf(
                signIn.pending,
            ), (state) => {
                state.loginLoading = true;
                state.loginError = null;
            })
            .addMatcher(isAnyOf(
                signIn.rejected,
            ),
                (state, action) => {
                    state.loginLoading = false;
                    state.loginError = action.error.message;
                });
    }
})

export default loginSlice;