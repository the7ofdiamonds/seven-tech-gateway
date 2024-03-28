import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidEmail, isValidConfirmationCode, isValidUsername, isValidPassword } from '../utils/Validation';

const forgotPasswordUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/forgot-password" : "/wp-json/seven-tech/v1/users/forgot-password";
const changePasswordUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/change-password" : "/wp-json/seven-tech/v1/users/change-password";
const updatePasswordUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/update-password" : "/wp-json/seven-tech/v1/users/update-password";

const initialState = {
    passwordLoading: false,
    passwordError: '',
    passwordSuccessMessage: '',
    passwordErrorMessage: '',
    passwordStatusCode: ''
};

export const updatePasswordSuccessMessage = () => {
    return {
        type: 'password/updatePasswordSuccessMessage',
        payload: ''
    };
};

export const updatePasswordErrorMessage = () => {
    return {
        type: 'password/updatePasswordErrorMessage',
        payload: ''
    };
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

export const changePassword = createAsyncThunk('password/changePassword', async ({ password, confirmPassword }) => {
    try {
        const accessToken = localStorage.getItem('access_token');

        if (!accessToken) {
            throw new Error("An access token is required to change your name.");
        }

        if (!password) {
            throw new Error("Enter your new preferred password.");
        }

        if (!confirmPassword) {
            throw new Error("Please enter your preferred new password twice.");
        }

        if (isValidPassword(password) == false) {
            throw new Error("The new Password you entered is not valid.");
        }

        if (password != confirmPassword) {
            throw new Error("Enter your new preferred password exactly the same twice.")
        }

        const response = await fetch(`${changePasswordUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                password: password,
                confirmPassword: confirmPassword
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const updatePassword = createAsyncThunk('password/updatePassword', async ({ email, confirmationCode, password, confirmPassword }) => {
    try {

        if (isValidEmail(email) == false) {
            throw new Error("Email is not valid.");
        }

        if (isValidConfirmationCode(confirmationCode) == false) {
            throw new Error("Confirmation Code is not valid.");
        }

        if (isValidPassword(password) == false) {
            throw new Error("Password is not valid.");
        }

        if (password != confirmPassword) {
            throw new Error("Please enter your new prefered password twice.")
        }

        const response = await fetch(`${updatePasswordUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "email": email,
                "confirmationCode": confirmationCode,
                "password": password,
                "confirmPassword": confirmPassword
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
    reducers: {
        updatePasswordSuccessMessage: (state, action) => {
            state.passwordSuccessMessage= action.payload;
        },
        updatePasswordErrorMessage: (state, action) => {
            state.passwordError = action.payload;
            state.passwordErrorMessage = action.payload;
        }
    },
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
                state.passwordStatusCode = action.payload.statusCode;
            })
            .addMatcher(isAnyOf(
                forgotPassword.pending,
                changePassword.pending,
                updatePassword.pending
            ), (state) => {
                state.passwordLoading = true;
                state.passwordError = '';
                state.passwordSuccessMessage = '';
                state.passwordErrorMessage = '';
                state.passwordStatusCode = '';
            })
            .addMatcher(isAnyOf(
                forgotPassword.rejected,
                changePassword.rejected,
                updatePassword.rejected
            ), (state, action) => {
                state.passwordLoading = false;
                state.passwordError = action.error;
                state.passwordErrorMessage = action.error.message;
                state.passwordStatusCode = action.payload.code;
            });
    }
})

export default passwordSlice;

