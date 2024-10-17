import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidEmail, isValidPassword, isValidConfirmationCode } from '../utils/Validation';

const lockAccountUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/lock-account" : "/wp-json/seven-tech/v1/account/lock";
const unlockAccountUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/unlock-account" : "/wp-json/seven-tech/v1/account/unlock";

const initialState = {
    accountLoading: false,
    accountError: '',
    accountSuccessMessage: '',
    accountErrorMessage: '',
    accountStatusCode: ''
};

export const updateAccountEmail = (email) => {
    return {
        type: 'account/updateAccountEmail',
        payload: email
    };
};

export const updateAccountSuccessMessage = () => {
    return {
        type: 'account/updateAccountSuccessMessage',
        payload: ''
    };
};

export const updateAccountErrorMessage = () => {
    return {
        type: 'account/updateAccountErrorMessage',
        payload: ''
    };
};

export const lockAccount = createAsyncThunk('account/lockAccount', async () => {
    try {
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        const response = await fetch(`${lockAccountUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            }
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const unlockAccount = createAsyncThunk('account/unlockAccount', async ({ email, confirmationCode }) => {
    try {

        if (isValidConfirmationCode(confirmationCode) != true) {
            throw new Error("Confirmation Code is not valid.");
        }

        if (isValidEmail(email) == false) {
            throw new Error("Email is not valid.");
        }

        const response = await fetch(`${unlockAccountUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
                confirmationCode: confirmationCode
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const accountSlice = createSlice({
    name: 'account',
    initialState,
    reducers: {
        updateAccountSuccessMessage: (state, action) => {
            state.accountSuccessMessage = action.payload;
        },
        updateAccountErrorMessage: (state, action) => {
            state.accountError = action.payload;
            state.accountErrorMessage = action.payload;
        }
    },
    extraReducers: (builder) => {
        builder
            .addMatcher(isAnyOf(
                lockAccount.fulfilled,
                unlockAccount.fulfilled
            ), (state, action) => {
                state.accountLoading = false;
                state.accountError = '';
                state.accountSuccessMessage = action.payload.successMessage;
                state.accountErrorMessage = action.payload.errorMessage;
                state.accountStatusCode = action.payload.statusCode;
            })
            .addMatcher(isAnyOf(
                lockAccount.pending,
                unlockAccount.pending
            ), (state) => {
                state.accountLoading = true;
                state.accountError = '';
                state.accountSuccessMessage = '';
                state.accountErrorMessage = '';
                state.accountStatusCode = '';
            })
            .addMatcher(isAnyOf(
                lockAccount.rejected,
                unlockAccount.rejected
            ), (state, action) => {
                state.accountLoading = false;
                state.accountError = action.error;
                state.accountErrorMessage = action.error.message;
                state.accountStatusCode = action.error.code;
            });
    }
})

export default accountSlice;