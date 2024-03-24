import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidConfirmationCode, isValidEmail, isValidPassword, isValidUsername } from '../utils/Validation';

const veryEmailUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/verify-email' : "/wp-json/seven-tech/v1/users/verify-email";
const addEmailUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/add-email' : "/wp-json/seven-tech/v1/users/add-email";
const removeEmailUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/remove-email' : "/wp-json/seven-tech/v1/users/remove-email";

const initialState = {
    emailLoading: false,
    emailError: '',
    emailSuccessMessage: '',
    emailErrorMessage: ''
};

export const verifyEmail = createAsyncThunk('email/verifyEmail', async ({ username, password, token, email, confirmationCode }) => {
    try {

        if (isValidUsername(username) == false || isValidPassword(password) == false && token == '') {
            throw new Error("A token or Username and password is required to verify the this email.");
        }

        if (isValidConfirmationCode(confirmationCode) == false) {
            throw new Error("Confirmation Code is not valid.");
        }

        if (isValidEmail(email) == false) {
            throw new Error("Email is not valid.");
        }

        const response = await fetch(`${veryEmailUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
                "password": password,
                "accessToken": token,
                "confirmationCode": confirmationCode,
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

export const addEmail = createAsyncThunk('email/addEmail', async ({ username, password, token, email }) => {
    try {

        if (isValidUsername(username) == false || isValidPassword(password) == false && token == '') {
            throw new Error("A token or Username and password is required to verify the this email.");
        }

        if (isValidEmail(email) == false) {
            throw new Error("Email is not valid.");
        }

        const response = await fetch(`${addEmailUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
                "password": password,
                "accessToken": token,
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

export const removeEmail = createAsyncThunk('email/removeEmail', async ({ username, password, token, email }) => {
    try {

        if (isValidUsername(username) == false || isValidPassword(password) == false && token == '') {
            throw new Error("A token or Username and password is required to verify the this email.");
        }

        if (isValidEmail(email) == false) {
            throw new Error("Email is not valid.");
        }

        const response = await fetch(`${removeEmailUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
                "password": password,
                "accessToken": token,
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

export const emailSlice = createSlice({
    name: 'email',
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addMatcher(isAnyOf(
                verifyEmail.fulfilled, addEmail.fulfilled, removeEmail.fulfilled
            ), (state, action) => {
                state.emailLoading = false;
                state.emailError = '';
                state.emailSuccessMessage = action.payload.successMessage;
                state.emailErrorMessage = action.payload.errorMessage;
            })
            .addMatcher(isAnyOf(
                verifyEmail.pending, addEmail.pending, removeEmail.pending
            ), (state) => {
                state.emailLoading = true;
                state.emailError = null;
                state.emailSuccessMessage = null;
                state.emailErrorMessage = null;
            })
            .addMatcher(isAnyOf(
                verifyEmail.rejected, addEmail.rejected, removeEmail.rejected
            ), (state, action) => {
                state.emailLoading = false;
                state.emailError = action.error;
                state.emailErrorMessage = action.error.message;
            });
    }
})

export default emailSlice;

