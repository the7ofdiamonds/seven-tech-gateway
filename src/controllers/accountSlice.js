import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidUsername, isValidPassword, isValidConfirmationCode } from '../utils/Validation';

const unlockAccountUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/unlock-account" : "/wp-json/seven-tech/v1/users/unlock-account";
const removeAccountUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/remove-account" : "/wp-json/seven-tech/v1/users/remove-account";

const initialState = {
    accountLoading: false,
    accountError: '',
    accountSuccessMessage: '',
    accountErrorMessage: ''
};

export const unlockAccount = createAsyncThunk('account/unlockAccount', async ({ username, password, confirmationCode }) => {
    try {

        if (isValidUsername(username) == false) {
            throw new Error("Username is not valid.");
        }

        if (isValidPassword(password) == false) {
            throw new Error("Password is not valid.");
        }

        if (isValidConfirmationCode(confirmationCode) == false) {
            throw new Error("Confirmation Code is not valid.");
        }

        const response = await fetch(`${unlockAccountUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
                "password": password,
                "confirmationCode": confirmationCode
            })
        });

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const removeAccount = createAsyncThunk('account/removeAccount', async ({ username, password, confirmationCode }) => {
    try {

        if (isValidUsername(username) == false) {
            throw new Error("Username is not valid.");
        }

        if (isValidPassword(password) == false) {
            throw new Error("Password is not valid.");
        }

        if (isValidConfirmationCode(confirmationCode) == false) {
            throw new Error("Confirmation Code is not valid.");
        }

        const response = await fetch(`${removeAccountUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
                "password": password,
                "confirmationCode": confirmationCode
            })
        });

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const accountSlice = createSlice({
    name: 'account',
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addMatcher(isAnyOf(
                unlockAccount.fulfilled,
                removeAccount.fulfilled
            ), (state, action) => {
                state.accountLoading = false;
                state.accountError = '';
                state.accountSuccessMessage = action.payload.successMessage;
                state.accountErrorMessage = action.payload.errorMessage;
            })
            .addMatcher(isAnyOf(
                unlockAccount.pending,
                removeAccount.pending
            ), (state) => {
                state.accountLoading = true;
                state.accountError = null;
                state.accountSuccessMessage = null;
                state.accountErrorMessage = null;
            })
            .addMatcher(isAnyOf(
                unlockAccount.rejected,
                removeAccount.rejected
            ), (state, action) => {
                state.accountLoading = false;
                state.accountError = action.error;
                state.accountErrorMessage = action.error;
            });
    }
})

export default accountSlice;