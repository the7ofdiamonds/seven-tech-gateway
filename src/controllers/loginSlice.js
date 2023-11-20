import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import {
    browserSessionPersistence,
    setPersistence,
    signInWithEmailAndPassword,
    getAuth,
} from 'firebase/auth';

import { projectAuth } from '../services/firebase/config.js';

const initialState = {
    userLoading: false,
    userError: '',
    user_login: '',
    user_pass: '',
    user_email: '',
    first_name: '',
    last_name: '',
    user_id: ''
};

// Use php in the backend

export const signInEmailAndPassword = createAsyncThunk('users/signInEmailAndPassword', async (credentials) => {
    try {
        const auth = getAuth();
        const Email = credentials.email;
        const Password = credentials.password;

        await signInWithEmailAndPassword(auth, Email, Password);
        setPersistence(auth, browserSessionPersistence);

        const user = projectAuth.currentUser;

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

export const getUser = createAsyncThunk('user/getUser', async (_, { getState }) => {
    try {
        const { user_email } = getState().user;
        const encodedEmail = encodeURIComponent(user_email);

        const response = await fetch(`/wp-json/seven-tech/v1/users/${encodedEmail}`, {
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

export const usersSlice = createSlice({
    name: 'users',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(signInEmailAndPassword.fulfilled, (state, action) => {
                state.userLoading = false
                state.userError = ''
                state.userMessage = action.payload
            })
    }
})

export default usersSlice;