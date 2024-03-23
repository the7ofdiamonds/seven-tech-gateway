import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidConfirmationCode, isValidEmail, isValidUsername, isValidPassword } from '../utils/Validation';

const changePasswordUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL : "/wp-json/seven-tech/v1/users/password-recovery";
const updatePasswordUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL : "/wp-json/seven-tech/v1/users/password-recovery";

const initialState = {
    passwordLoading: false,
    passwordError: '',
    passwordSuccessMessage: '',
    passwordErrorMessage: ''
};

export const changePassword = createAsyncThunk('password/updatePassword', async ({username, confirmationCode, password}) => {
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

export const updatePassword = createAsyncThunk('password/updatePassword', async ({username, confirmationCode, password}) => {
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
            .addCase(updatePassword.fulfilled, (state, action) => {
                state.passwordLoading = false;
                state.passwordError = '';
                state.passwordSuccessMessage = action.payload.successMessage;
                state.passwordErrorMessage = action.payload.errorMessage;
            })
            .addMatcher(isAnyOf(
                updatePassword.pending,
            ), (state) => {
                state.passwordLoading = true;
                state.passwordError = null;
                state.passwordSuccessMessage = null;
                state.passwordErrorMessage = null;
            })
            .addMatcher(isAnyOf(
                updatePassword.rejected,
            ),
                (state, action) => {
                    state.passwordLoading = false;
                    state.passwordError = action.error;
                    state.passwordErrorMessage = action.error;
                });
    }
})

export default passwordSlice;


// Unlock Account

// Remove Account