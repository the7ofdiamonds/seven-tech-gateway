import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidUsername, isValidPhone, isValidName } from '../utils/Validation';

const changeNameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-name' : "/wp-json/seven-tech/v1/users/change-name";
const changePhoneUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-phone' : "/wp-json/seven-tech/v1/users/change-phone";
const changeUsernameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-username' : "/wp-json/seven-tech/v1/users/change-username";

const initialState = {
    changeLoading: false,
    changeError: '',
    changeSuccessMessage: '',
    changeErrorMessage: '',
    changeStatusCode: '',
    username: '',
    firstname: '',
    lastname: '',
    phone: ''
};

export const updateChangeSuccessMessage = () => {
    return {
        type: 'change/updateChangeSuccessMessage',
        payload: ''
    };
};

export const updateChangeErrorMessage = () => {
    return {
        type: 'change/updateChangeErrorMessage',
        payload: ''
    };
};

export const changeName = createAsyncThunk('change/changeName', async ({ firstName, lastName }) => {
    try {
        const accessToken = localStorage.getItem('access_token');

        if (!accessToken) {
            throw new Error("An access token is required to change your name.");
        }

        if (!firstName) {
            throw new Error("The first name is blank.");
        }

        if (!lastName) {
            throw new Error("The last name is blank.");
        }

        if (!isValidName(firstName)) {
            throw new Error("The first name provided is not valid.");
        }

        if (!isValidName(lastName)) {
            throw new Error("The last name provided is not valid.");
        }

        const response = await fetch(changeNameUrl, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                firstName: firstName,
                lastName: lastName
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
                phone: phone
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
                username: username
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
    reducers: {
        updateChangeSuccessMessage: (state, action) => {
            state.changeSuccessMessage = action.payload;
        },
        updateChangeErrorMessage: (state, action) => {
            state.changeError = action.payload;
            state.changeErrorMessage = action.payload;
        }
    },
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
                state.changeStatusCode = action.payload.statusCode;
                state.username = action.payload.username;
                state.firstname = action.payload.firstname;
                state.lastname = action.payload.lastname;
                state.phone = action.payload.phone;
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
                state.changeStatusCode = '';
            })
            .addMatcher(isAnyOf(
                changeName.rejected,
                changePhone.rejected,
                changeUsername.rejected
            ), (state, action) => {
                state.changeLoading = false;
                state.changeError = action.error;
                state.changeErrorMessage = action.error.message;
                state.changeStatusCode = action.error.code;
            });
    }
})

export default changeSlice;

