import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import { isValidUsername, isValidPassword, isValidName, isValidPhone } from '../utils/Validation';

const signupUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/signup' : '/wp-json/seven-tech/v1/users/v1/signup';

const initialState = {
    signupLoading: false,
    signupError: '',
    signupSuccessMessage: '',
    signupErrorMessage: '',
};

export const signup = createAsyncThunk('signup/signup', async (credentials) => {
    try {

        if (isValidEmail(credentials.email) == false) {
            throw new Error("A valid Email is required to signup.");
        }

        if (isValidUsername(credentials.username) == false) {
            throw new Error("A valid Username is required to signup.");
        }

        if (isValidPassword(credentials.password) == false) {
            throw new Error("A valid password is required to signup.");
        }

        if (credentials.password != credentials.confirmPassword) {
            throw new Error("Please enter your prefered password twice.");
        }

        if (isValidName(credentials.firstname) == false) {
            throw new Error("Please provide a valid first name.");
        }

        if (isValidName(credentials.lastname) == false) {
            throw new Error("Please provide a valid last name.");
        }

        if (isValidPhone(credentials.phone) == false) {
            throw new Error("Please provide a valid phone number.");
        }
// Validate location
        const response = await fetch(signupUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "email": credentials.email,
                "username": credentials.username,
                "password": credentials.password,
                "confirmPassword": credentials.confirmPassword,
                "firstname": credentials.firstname,
                "lastname": credentials.lastname,
                "phone": credentials.phone,
                "location": credentials.location
            })
        });

        if (!response.ok) {
            const errorData = await response.json();
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        const errorCode = error.code;
        const errorMessage = error.message;

        return `Error (${errorCode}): ${errorMessage}`;
    }
});

export const signupSlice = createSlice({
    name: 'signup',
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addCase(signup.fulfilled, (state, action) => {
                state.signupLoading = false;
                state.signupError = '';
                state.signupSuccessMessage = action.payload.successMessage;
                state.signupErrorMessage = action.payload.errorMessage;
            })
            .addMatcher(isAnyOf(
                signup.pending,
            ), (state) => {
                state.signupLoading = true;
                state.signupError = null;
                state.signupSuccessMessage = null;
                state.signupErrorMessage = null;
            })
            .addMatcher(isAnyOf(
                signup.rejected,
            ), (state, action) => {
                state.signupLoading = false;
                state.signupError = action.error.stack;
                state.signupErrorMessage = action.error.message;
            });
    }
})

export default signupSlice;