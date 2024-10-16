import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidUsername, isValidPhone, isValidName, isValidEmail } from '../utils/Validation';

const changeUsernameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change/username' : "/wp-json/seven-tech/v1/change/username";
const changeNameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change/name' : "/wp-json/seven-tech/v1/change/name";
const changeNicknameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change/nickname' : "/wp-json/seven-tech/v1/change/nickname";
const changeNicenameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change/nicename' : "/wp-json/seven-tech/v1/change/nicename";
const changePhoneUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change/phone' : "/wp-json/seven-tech/v1/change/phone";

const initialState = {
    userLoading: false,
    userError: '',
    userSuccessMessage: '',
    userErrorMessage: '',
    userStatusCode: '',
    username: '',
    firstname: '',
    lastname: '',
    nickname: '',
    nicename: '',
    roles: '',
    phone: ''
};

export const updateChangeSuccessMessage = () => {
    return {
        type: 'user/updateChangeSuccessMessage',
        payload: ''
    };
};

export const updateChangeErrorMessage = () => {
    return {
        type: 'user/updateChangeErrorMessage',
        payload: ''
    };
};

export const changeUsername = createAsyncThunk('change/changeUsername', async (username) => {
    try {
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (!isValidUsername(username)) {
            throw Error("Username is not valid.")
        }

        const response = await fetch(`${changeUsernameUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                username: username
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const changeName = createAsyncThunk('change/changeName', async ({ firstName, lastName }) => {
    try {
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (firstName == '' && lastName == '') {
            throw new Error("A first or last name is required to be changed.");
        }

        const response = await fetch(changeNameUrl, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                first_name: firstName,
                last_name: lastName
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const changeNickname = createAsyncThunk('change/changeNickname', async (nickname) => {
    try {
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (!isValidName(nickname)) {
            throw Error("Nick name is not valid.")
        }

        const response = await fetch(`${changeNicknameUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nickname: nickname
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const changeNicename = createAsyncThunk('change/changeNicename', async (nicename) => {
    try {
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (!isValidName(nicename)) {
            throw Error("Nice name is not valid.")
        }

        const response = await fetch(`${changeNicenameUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nicename: nicename
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const changePhone = createAsyncThunk('change/changePhone', async (phone) => {
    try {
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (!isValidPhone(phone)) {
            throw Error("There was an error changing your phone number.")
        }

        const response = await fetch(`${changePhoneUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                phone: phone
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const changeSlice = createSlice({
    name: 'change',
    initialState,
    reducers: {
        updateChangeSuccessMessage: (state, action) => {
            state.userSuccessMessage = action.payload;
        },
        updateChangeErrorMessage: (state, action) => {
            state.userError = action.payload;
            state.userErrorMessage = action.payload;
        }
    },
    extraReducers: (builder) => {
        builder
            .addCase(
                changeUsername.fulfilled, (state, action) => {
                    state.userLoading = false;
                    state.userError = '';
                    state.userSuccessMessage = action.payload.successMessage;
                    state.userErrorMessage = action.payload.errorMessage;
                    state.userStatusCode = action.payload.statusCode;
                    state.username = action.payload.username;
                })
            .addCase(
                changeName.fulfilled, (state, action) => {
                    state.userLoading = false;
                    state.userError = '';
                    state.userSuccessMessage = action.payload.successMessage;
                    state.userErrorMessage = action.payload.errorMessage;
                    state.userStatusCode = action.payload.statusCode;
                    state.firstname = action.payload.firstname;
                    state.lastname = action.payload.lastname;
                })
            .addCase(
                changeNickname.fulfilled, (state, action) => {
                    state.userLoading = false;
                    state.userError = '';
                    state.userSuccessMessage = action.payload.successMessage;
                    state.userErrorMessage = action.payload.errorMessage;
                    state.userStatusCode = action.payload.statusCode;
                    state.nickname = action.payload.nickname;
                })
            .addCase(
                changeNicename.fulfilled, (state, action) => {
                    state.userLoading = false;
                    state.userError = '';
                    state.userSuccessMessage = action.payload.successMessage;
                    state.userErrorMessage = action.payload.errorMessage;
                    state.userStatusCode = action.payload.statusCode;
                    state.nicename = action.payload.nicename;
                })
            .addCase(
                changePhone.fulfilled, (state, action) => {
                    state.userLoading = false;
                    state.userError = '';
                    state.userSuccessMessage = action.payload.successMessage;
                    state.userErrorMessage = action.payload.errorMessage;
                    state.userStatusCode = action.payload.statusCode;
                    state.phone = action.payload.phone;
                })
            .addMatcher(isAnyOf(
                changeUsername.pending,
                changeName.pending,
                changeNickname.pending,
                changeNicename.pending,
                changePhone.pending
            ), (state) => {
                state.userLoading = true;
                state.userError = null;
                state.userSuccessMessage = '';
                state.userErrorMessage = '';
                state.userStatusCode = '';
            })
            .addMatcher(isAnyOf(
                changeUsername.rejected,
                changeName.rejected,
                changeNickname.rejected,
                changeNicename.rejected,
                changePhone.rejected
            ), (state, action) => {
                state.userLoading = false;
                state.userError = action.error;
                state.userErrorMessage = action.error.message;
                state.userStatusCode = action.error.code;
            });
    }
})

export default changeSlice;