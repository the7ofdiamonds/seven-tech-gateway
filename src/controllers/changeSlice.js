import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidConfirmationCode, isValidEmail, isValidUsername, isValidPassword } from '../utils/Validation';

const updatePasswordUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL : "/wp-json/seven-tech/v1/users/password-recovery";

const initialState = {
    changeLoading: false,
    changeError: '',
    changeSuccessMessage: '',
    changeErrorMessage: ''
};

// Change Name

// Change Password

export const updatePassword = createAsyncThunk('change/updatePassword', async ({username, confirmationCode, password}) => {
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

// Change Phone

// Change Username

export const changeSlice = createSlice({
    name: 'change',
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addCase(updatePassword.fulfilled, (state, action) => {
                state.changeLoading = false;
                state.changeError = '';
                state.changeSuccessMessage = action.payload.successMessage;
                state.changeErrorMessage = action.payload.errorMessage;
            })
            .addMatcher(isAnyOf(
                updatePassword.pending,
            ), (state) => {
                state.changeLoading = true;
                state.changeError = null;
                state.changeSuccessMessage = null;
                state.changeErrorMessage = null;
            })
            .addMatcher(isAnyOf(
                updatePassword.rejected,
            ),
                (state, action) => {
                    state.changeLoading = false;
                    state.changeError = action.error;
                    state.changeErrorMessage = action.error;
                });
    }
})

export default changeSlice;

