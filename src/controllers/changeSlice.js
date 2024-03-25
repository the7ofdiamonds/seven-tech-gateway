import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidUsername, isValidPhone, isValidName } from '../utils/Validation';

const changeNameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-name' : "/wp-json/seven-tech/v1/users/change-name";
const changePhoneUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-phone' : "/wp-json/seven-tech/v1/users/change-phone";
const changeUsernameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-username' : "/wp-json/seven-tech/v1/users/change-username";

const initialState = {
    changeLoading: false,
    changeError: '',
    changeSuccessMessage: '',
    changeErrorMessage: ''
};

export const changeName = createAsyncThunk('change/changeName', async ({ firstNameChange, lastNameChange }) => {
    try {
        const accessToken = localStorage.getItem('access_token');

        if (!accessToken) {
            throw new Error("An access token is required to change your name.");
        }

        if (!firstNameChange) {
            throw new Error("The first name is blank.");
        }

        if (!lastNameChange) {
            throw new Error("The last name is blank.");
        }

        if (!isValidName(firstNameChange)) {
            throw new Error("The first name provided is not valid.");
        }

        if (!isValidName(lastNameChange)) {
            throw new Error("The last name provided is not valid.");
        }

        const response = await fetch(changeNameUrl, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "firstname": firstNameChange,
                "lastname": lastNameChange
            })
        });

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.error(error);
        throw error;
    }
});

export const changePhone = createAsyncThunk('change/changePhone', async (phone) => {
    try {
        const accessToken = localStorage.getItem('access_token');

        if (accessToken == '') {
            throw Error("An access token is required to change your phone number.")
        }

        if (isValidPhone(phone) != true) {
            throw Error("There was an error changing your phone number.")
        }

        const response = await fetch(`${changePhoneUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
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

export const changeUsername = createAsyncThunk('change/changeUsername', async (username) => {
    try {
        const accessToken = localStorage.getItem('access_token');

        if (accessToken == '') {
            throw Error("An access token is required to change your username.")
        }

        if (isValidUsername(username) != true) {
            throw Error("There was an error changing your username.")
        }

        const response = await fetch(`${changeUsernameUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
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
                state.changeErrorMessage = '';
            })
            .addMatcher(isAnyOf(
                changeName.pending,
                changePhone.pending,
                changeUsername.pending
            ), (state) => {
                state.changeLoading = true;
                state.changeError = null;
                state.changeSuccessMessage = '';
                state.changeErrorMessage = '';
            })
            .addMatcher(isAnyOf(
                changeName.rejected,
                changePhone.rejected,
                changeUsername.rejected
            ), (state, action) => {
                state.changeLoading = false;
                state.changeError = action.error;
                state.changeErrorMessage = action.error.message;
            });
    }
})

export default changeSlice;

