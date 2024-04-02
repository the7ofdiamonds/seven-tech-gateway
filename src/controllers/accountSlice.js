import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidEmail, isValidPassword, isValidConfirmationCode } from '../utils/Validation';

const sendUnlockAccountEmailUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/unlock-account" : "/wp-json/seven-tech/v1/users/unlock-account";
const sendRemoveAccountEmailUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/remove-account" : "/wp-json/seven-tech/v1/users/remove-account";
const unlockAccountUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/unlock-account" : "/wp-json/seven-tech/v1/users/unlock-account";
const removeAccountUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/remove-account" : "/wp-json/seven-tech/v1/users/remove-account";

const initialState = {
    accountLoading: false,
    accountError: '',
    accountSuccessMessage: '',
    accountErrorMessage: '',
    accountStatusCode: '',
    email: '',
    username: '',
    firstname: '',
    lastname: '',
    phone: ''
};

export const updateAccountEmail = (email) => {
    return {
        type: 'account/updateAccountEmail',
        payload: email
    };
};

export const updateAccountUsername = (username) => {
    return {
        type: 'account/updateAccountUsername',
        payload: username
    };
};

export const updateAccountFirstName = (firstname) => {
    return {
        type: 'account/updateAccountFirstName',
        payload: firstname
    };
};

export const updateAccountLastName = (lastname) => {
    return {
        type: 'account/updateAccountLastName',
        payload: lastname
    };
};

export const updateAccountPhone = (phone) => {
    return {
        type: 'account/updateAccountPhone',
        payload: phone
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

export const sendUnlockAccountEmail = createAsyncThunk('account/sendUnlockAccountEmail', async (email) => {
    try {

        if (isValidEmail(email) == false) {
            throw new Error("Email is not valid.");
        }

        const response = await fetch(`${sendUnlockAccountEmailUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const sendRemoveAccountEmail = createAsyncThunk('account/sendRemoveAccountEmail', async (email) => {
    try {

        if (isValidEmail(email) == false) {
            throw new Error("Email is not valid.");
        }

        const response = await fetch(`${sendRemoveAccountEmailUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
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
        console.error(error)
        throw error;
    }
});

export const removeAccount = createAsyncThunk('account/removeAccount', async ({ email, password, confirmationCode }) => {
    try {

        if (isValidEmail(email) == false) {
            throw new Error("Email is not valid.");
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
                email: email,
                password: password,
                confirmationCode: confirmationCode
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
    reducers: {
        updateAccountSuccessMessage: (state, action) => {
            state.accountSuccessMessage = action.payload;
        },
        updateAccountErrorMessage: (state, action) => {
            state.accountError = action.payload;
            state.accountErrorMessage = action.payload;
        },
        updateAccountEmail: (state, action) => {
            state.email = action.payload;
        },
        updateAccountUsername: (state, action) => {
            state.username = action.payload;
        },
        updateAccountFirstName: (state, action) => {
            state.firstname = action.payload;
        },
        updateAccountLastName: (state, action) => {
            state.lastname = action.payload;
        },
        updateAccountPhone: (state, action) => {
            state.phone = action.payload;
        },
    },
    extraReducers: (builder) => {
        builder
            .addMatcher(isAnyOf(
                sendUnlockAccountEmail.fulfilled,
                unlockAccount.fulfilled,
                sendRemoveAccountEmail.fulfilled,
                removeAccount.fulfilled
            ), (state, action) => {
                state.accountLoading = false;
                state.accountError = '';
                state.accountSuccessMessage = action.payload.successMessage;
                state.accountErrorMessage = action.payload.errorMessage;
                state.accountStatusCode = action.payload.statusCode;
            })
            .addMatcher(isAnyOf(
                sendUnlockAccountEmail.pending,
                unlockAccount.pending,
                sendRemoveAccountEmail.pending,
                removeAccount.pending
            ), (state) => {
                state.accountLoading = true;
                state.accountError = '';
                state.accountSuccessMessage = '';
                state.accountErrorMessage = '';
                state.accountStatusCode = '';
            })
            .addMatcher(isAnyOf(
                sendUnlockAccountEmail.rejected,
                unlockAccount.rejected,
                sendRemoveAccountEmail.rejected,
                removeAccount.rejected
            ), (state, action) => {
                state.accountLoading = false;
                state.accountError = action.error;
                state.accountErrorMessage = action.error.message;
                state.accountStatusCode = action.error.code;
            });
    }
})

export default accountSlice;