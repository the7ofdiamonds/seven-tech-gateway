import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidEmail, isValidConfirmationCode, isValidUsername, isValidPassword } from '../utils/Validation';

const forgotPasswordUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/forgot-password" : "/wp-json/seven-tech/v1/users/forgot-password";
const changePasswordUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/change-password" : "/wp-json/seven-tech/v1/users/change-password";
const updatePasswordUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/update-password" : "/wp-json/seven-tech/v1/users/update-password";

const initialState = {
    passwordLoading: false,
    passwordError: '',
    passwordSuccessMessage: '',
    passwordErrorMessage: ''
};

export const forgotPassword = createAsyncThunk('password/forgotPassword', async (email) => {
    try {

        if (isValidEmail(email) == false) {
            throw new Error("Email is not valid.");
        }

        const response = await fetch(`${forgotPasswordUrl}`, {
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

export const changePassword = createAsyncThunk('password/changePassword', async ({ newPassword, confirmNewPassword }) => {
    try {

        // if (isValidUsername(username) == false) {
        //     throw new Error("Username is not valid.");
        // }

        // if (isValidPassword(password) == false) {
        //     throw new Error("Password is not valid.");
        // }

        if (isValidPassword(newPassword) == false) {
            throw new Error("The new Password you entered is not valid.");
        }

        if (newPassword != confirmNewPassword) {
            throw new Error("Please enter your prefered new password twice.")
        }

        const response = await fetch(`${changePasswordUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
                "password": password,
                "newPassword": newPassword
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const updatePassword = createAsyncThunk('password/updatePassword', async ({ username, confirmationCode, password, confirmPassword }) => {
    try {

        if (isValidUsername(username) == false) {
            throw new Error("Username is not valid.");
        }

        if (isValidConfirmationCode(confirmationCode) == false) {
            throw new Error("Confirmation Code is not valid.");
        }

        if (isValidPassword(password) == false) {
            throw new Error("Password is not valid.");
        }

        if (password != confirmPassword) {
            throw new Error("Please enter your prefered new password twice.")
        }

        const response = await fetch(`${updatePasswordUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
                "confirmationCode": confirmationCode,
                "password": password
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const passwordSlice = createSlice({
    name: 'password',
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addMatcher(isAnyOf(
                forgotPassword.fulfilled,
                changePassword.fulfilled,
                updatePassword.fulfilled
            ), (state, action) => {
                state.passwordLoading = false;
                state.passwordError = '';
                state.passwordSuccessMessage = action.payload.successMessage;
                state.passwordErrorMessage = action.payload.errorMessage;
            })
            .addMatcher(isAnyOf(
                forgotPassword.pending,
                changePassword.pending,
                updatePassword.pending
            ), (state) => {
                state.passwordLoading = true;
                state.passwordError = null;
                state.passwordSuccessMessage = '';
                state.passwordErrorMessage = '';
            })
            .addMatcher(isAnyOf(
                forgotPassword.rejected,
                changePassword.rejected,
                updatePassword.rejected
            ), (state, action) => {
                state.passwordLoading = false;
                state.passwordError = action.error;
                state.passwordErrorMessage = action.error.message;
            });
    }
})

export default passwordSlice;

