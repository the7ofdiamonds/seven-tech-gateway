import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidUsername, isValidPassword, isValidConfirmationCode } from '../utils/Validation';

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

export const unlockAccount = createAsyncThunk('account/unlockAccount', async ({ username, password, confirmationCode }) => {
    try {

        if (isValidUsername(username) != true) {
            throw new Error("Username is not valid.");
        }

        if (isValidPassword(password) != true) {
            throw new Error("Password is not valid.");
        }

        if (isValidConfirmationCode(confirmationCode) != true) {
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
                unlockAccount.fulfilled,
                removeAccount.fulfilled
            ), (state, action) => {
                state.accountLoading = false;
                state.accountError = '';
                state.accountSuccessMessage = action.payload.successMessage;
                state.accountErrorMessage = action.payload.errorMessage;
                state.accountStatusCode = action.payload.statusCode;
            })
            .addMatcher(isAnyOf(
                unlockAccount.pending,
                removeAccount.pending
            ), (state) => {
                state.accountLoading = true;
                state.accountError = '';
                state.accountSuccessMessage = '';
                state.accountErrorMessage = '';
                state.accountStatusCode = '';
            })
            .addMatcher(isAnyOf(
                unlockAccount.rejected,
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