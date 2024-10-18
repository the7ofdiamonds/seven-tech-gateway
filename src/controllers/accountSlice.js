import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const activateAccountUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/account/activate' : "/wp-json/seven-tech/v1/account/activate";
const lockAccountUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/account/lock" : "/wp-json/seven-tech/v1/account/lock";
const unlockAccountUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/account/unlock" : "/wp-json/seven-tech/v1/account/unlock";
const recoverAccountUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/account/recovery" : "/wp-json/seven-tech/v1/account/recovery";

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

export const activateAccount = createAsyncThunk('account/activateAccount', async ({ email, userActivationKey }) => {
    try {
        const response = await fetch(`${activateAccountUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                user_activation_key: userActivationKey,
                email: email
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

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

export const unlockAccount = createAsyncThunk('account/unlockAccount', async ({ email, userActivationKey }) => {
    try {
        const response = await fetch(`${unlockAccountUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
                user_activation_key: userActivationKey,
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const recoverAccount = createAsyncThunk('account/recoverAccount', async ({ email, userActivationKey }) => {
    try {
        const response = await fetch(`${recoverAccountUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
                user_activation_key: userActivationKey,
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
                activateAccount.fulfilled,
                lockAccount.fulfilled,
                unlockAccount.fulfilled,
                recoverAccount.fulfilled
            ), (state, action) => {
                state.accountLoading = false;
                state.accountError = '';
                state.accountSuccessMessage = action.payload.successMessage;
                state.accountErrorMessage = action.payload.errorMessage;
                state.accountStatusCode = action.payload.statusCode;
            })
            .addMatcher(isAnyOf(
                activateAccount.pending,
                lockAccount.pending,
                unlockAccount.pending,
                recoverAccount.pending
            ), (state) => {
                state.accountLoading = true;
                state.accountError = '';
                state.accountSuccessMessage = '';
                state.accountErrorMessage = '';
                state.accountStatusCode = '';
            })
            .addMatcher(isAnyOf(
                activateAccount.rejected,
                lockAccount.rejected,
                unlockAccount.rejected,
                recoverAccount.rejected
            ), (state, action) => {
                state.accountLoading = false;
                state.accountError = action.error;
                state.accountErrorMessage = action.error.message;
                state.accountStatusCode = action.error.code;
            });
    }
})

export default accountSlice;