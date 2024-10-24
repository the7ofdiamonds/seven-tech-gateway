import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidUsername, isValidPhone, isValidName } from '../utils/Validation';

const changeUsernameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change/username' : "/wp-json/seven-tech/v1/change/username";
const changeNameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change/name' : "/wp-json/seven-tech/v1/change/name";

const changeNicknameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change/nickname' : "/wp-json/seven-tech/v1/change/nickname";
const changeNicenameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change/nicename' : "/wp-json/seven-tech/v1/change/nicename";
const changePhoneUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change/phone' : "/wp-json/seven-tech/v1/change/phone";

const initialState = {
    changeLoading: false,
    changeError: '',
    changeSuccessMessage: '',
    changeErrorMessage: '',
    changeStatusCode: '',
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

export const changeName = createAsyncThunk('change/changeName', async (fullName) => {
    try {
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        const headers = new Headers();
        headers.append("Authorization", "Bearer " + accessToken);
        headers.append("Refresh-Token", refreshToken);
        headers.append("Content-Type", "application/json");

        if (fullName.first_name == '' && fullName.last_name == '') {
            throw new Error("A first or last name is required to be changed.");
        }

        const request = new Request(changeNameUrl, {
            method: 'POST',
            headers: headers,
            body: JSON.stringify({
                first_name: fullName.first_name,
                last_name: fullName.last_name
            })
        });

        const response = await fetch(request);

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
            state.changeSuccessMessage = action.payload;
        },
        updateChangeErrorMessage: (state, action) => {
            state.changeError = action.payload;
            state.changeErrorMessage = action.payload;
        }
    },
    extraReducers: (builder) => {
        builder
            .addCase(
                changeUsername.fulfilled, (state, action) => {
                    state.changeLoading = false;
                    state.changeError = '';
                    state.changeSuccessMessage = action.payload.successMessage;
                    state.changeErrorMessage = action.payload.errorMessage;
                    state.changeStatusCode = action.payload.statusCode;
                    state.username = action.payload.username;
                })
            .addCase(
                changeName.fulfilled, (state, action) => {
                    state.changeLoading = false;
                    state.changeError = '';
                    state.changeSuccessMessage = action.payload.successMessage;
                    state.changeErrorMessage = action.payload.errorMessage;
                    state.changeStatusCode = action.payload.statusCode;
                    state.firstname = action.payload.firstname;
                    state.lastname = action.payload.lastname;
                })
            .addCase(
                changeNickname.fulfilled, (state, action) => {
                    state.changeLoading = false;
                    state.changeError = '';
                    state.changeSuccessMessage = action.payload.successMessage;
                    state.changeErrorMessage = action.payload.errorMessage;
                    state.changeStatusCode = action.payload.statusCode;
                    state.nickname = action.payload.nickname;
                })
            .addCase(
                changeNicename.fulfilled, (state, action) => {
                    state.changeLoading = false;
                    state.changeError = '';
                    state.changeSuccessMessage = action.payload.successMessage;
                    state.changeErrorMessage = action.payload.errorMessage;
                    state.changeStatusCode = action.payload.statusCode;
                    state.nicename = action.payload.nicename;
                })
            .addCase(
                changePhone.fulfilled, (state, action) => {
                    state.changeLoading = false;
                    state.changeError = '';
                    state.changeSuccessMessage = action.payload.successMessage;
                    state.changeErrorMessage = action.payload.errorMessage;
                    state.changeStatusCode = action.payload.statusCode;
                    state.phone = action.payload.phone;
                })
            .addMatcher(isAnyOf(
                changeUsername.pending,
                changeName.pending,
                changeNickname.pending,
                changeNicename.pending,
                changePhone.pending
            ), (state) => {
                state.changeLoading = true;
                state.changeError = null;
                state.changeSuccessMessage = '';
                state.changeErrorMessage = '';
                state.changeStatusCode = '';
            })
            .addMatcher(isAnyOf(
                changeUsername.rejected,
                changeName.rejected,
                changeNickname.rejected,
                changeNicename.rejected,
                changePhone.rejected
            ), (state, action) => {
                state.changeLoading = false;
                state.changeError = action.error;
                state.changeErrorMessage = action.error.message;
                state.changeStatusCode = action.error.code;
            });
    }
})

export default changeSlice;