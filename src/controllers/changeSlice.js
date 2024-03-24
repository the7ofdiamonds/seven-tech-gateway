import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidEmail, isValidUsername, isValidPassword } from '../utils/Validation';

const changeNameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-name' : "/wp-json/seven-tech/v1/users/change-name";
const changePhoneUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-phone' : "/wp-json/seven-tech/v1/users/change-phone";
const changeUsernameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-username' : "/wp-json/seven-tech/v1/users/change-username";

const initialState = {
    changeLoading: false,
    changeError: '',
    changeSuccessMessage: '',
    changeErrorMessage: ''
};

export const changeName = createAsyncThunk('change/changeName', async ({ username, password, name }) => {
    try {

        if (isValidUsername(username) == false) {
            throw new Error("Username is not valid.");
        }

        if (isValidPassword(password) == false) {
            throw new Error("Password is not valid.");
        }

        if (isValidName(name) == false) {
            throw new Error("Name is not valid.");
        }

        const response = await fetch(`${changeNameUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
                "password": password,
                "name": name
            })
        });

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const changePhone = createAsyncThunk('change/changePhone', async ({ username, password, phone }) => {
    try {

        if (isValidUsername(username) == false) {
            throw new Error("Username is not valid.");
        }

        if (isValidPassword(password) == false) {
            throw new Error("Password is not valid.");
        }

        if (isValidPhone(phone) == false) {
            throw new Error("Phone is not valid.");
        }

        const response = await fetch(`${changePhoneUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
                "password": password,
                "phone": phone
            })
        });

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const changeUsername = createAsyncThunk('change/changeUsername', async ({ email, password, username }) => {
    try {

        if (isValidEmail(email) == false) {
            throw new Error("Email is not valid.");
        }

        if (isValidPassword(password) == false) {
            throw new Error("Password is not valid.");
        }

        if (isValidUsername(username) == false) {
            throw new Error("Username is not valid.");
        }

        const response = await fetch(`${changeUsernameUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "email": email,
                "password": password,
                "username": username
            })
        });

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const changeSlice = createSlice({
    name: 'change',
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addMatcher(isAnyOf(
                changeName.fulfilled,
                changePhone.fulfilled,
                changeUsername.fulfilled
            ), (state, action) => {
                state.changeLoading = false;
                state.changeError = '';
                state.changeSuccessMessage = action.payload.successMessage;
                state.changeErrorMessage = action.payload.errorMessage;
            })
            .addMatcher(isAnyOf(
                changeName.pending,
                changePhone.pending,
                changeUsername.pending
            ), (state) => {
                state.changeLoading = true;
                state.changeError = null;
                state.changeSuccessMessage = null;
                state.changeErrorMessage = null;
            })
            .addMatcher(isAnyOf(
                changeName.rejected,
                changePhone.rejected,
                changeUsername.rejected
            ), (state, action) => {
                state.changeLoading = false;
                state.changeError = action.error;
                state.changeErrorMessage = action.error;
            });
    }
})

export default changeSlice;

