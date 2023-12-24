import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import {
    browserSessionPersistence,
    setPersistence,
    signInWithEmailAndPassword,
    getAuth,
} from 'firebase/auth';

import { firebaseAuth } from '../services/firebase/config.js';

const initialState = {
    loginLoading: false,
    loginError: '',
    user_login: '',
    user_pass: '',
    user_email: '',
    first_name: '',
    last_name: '',
    user_id: ''
};

// Use php in the backend

export const signInEmailAndPassword = createAsyncThunk('login/signInEmailAndPassword', async (credentials) => {
    try {
        const auth = getAuth();
        const Email = credentials.email;
        const Password = credentials.password;

        await signInWithEmailAndPassword(auth, Email, Password);
        setPersistence(auth, browserSessionPersistence);

        const user = firebaseAuth.currentUser;

        if (!user) {
            throw new Error('User not found.', 404);
        }

        sessionStorage.setItem('email', Email);

        const token = await user.getIdToken();
        const data = { idToken: token, user_password: Password };

        const response = await fetch('/wp-json/seven-tech/v1/users/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
console.log(response);
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
            .addCase(signInEmailAndPassword.fulfilled, (state, action) => {
                state.loginLoading = false;
                state.loginError = '';
                state.loginMessage = action.payload;
            })
            .addMatcher(isAnyOf(
                signInEmailAndPassword.pending,
            ), (state) => {
                state.loginLoading = true;
                state.loginError = null;
            })
            .addMatcher(isAnyOf(
                signInEmailAndPassword.rejected,
            ),
                (state, action) => {
                    state.loginLoading = false;
                    state.loginError = action.error.message;
                });
    }
})

export default loginSlice;