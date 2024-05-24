import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidUsername, isValidPhone, isValidName, isValidEmail } from '../utils/Validation';

const getUserUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/get' : "/wp-json/seven-tech/v1/user/get";
const changeUsernameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-username' : "/wp-json/seven-tech/v1/user/change-username";
const changeNameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-name' : "/wp-json/seven-tech/v1/user/change-name";
const changeNicknameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-nickname' : "/wp-json/seven-tech/v1/user/change-nickname";
const changeNicenameUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-nicename' : "/wp-json/seven-tech/v1/user/change-nicename";
const addUserRoleUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/add-role' : "/wp-json/seven-tech/v1/user/roles/add";
const removeUserRoleUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/remove-role' : "/wp-json/seven-tech/v1/user/roles/remove";
const changePhoneUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/change-phone' : "/wp-json/seven-tech/v1/user/change-phone";

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

export const getUser = createAsyncThunk('user/getUser', async () => {
    try {
        const email = localStorage.getItem('email');
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (accessToken == '') {
            throw Error("An access token is required to get user data.")
        }

        if (refreshToken == '') {
            throw Error("A refresh token is required to get user data.")
        }

        if (!isValidEmail(email)) {
            throw new Error("The email provided is not valid.");
        }

        const response = await fetch(`${getUserUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
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

export const changeUsername = createAsyncThunk('user/changeUsername', async (username) => {
    try {
        const email = localStorage.getItem('email');
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (accessToken == '') {
            throw Error("An access token is required to change your username.")
        }

        if (refreshToken == '') {
            throw Error("An refresh token is required to change your username.")
        }

        if (!isValidEmail(email)) {
            throw new Error("The email provided is not valid.");
        }

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
                email: email,
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

export const changeName = createAsyncThunk('user/changeName', async ({ firstName, lastName }) => {
    try {
        const email = localStorage.getItem('email');
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (accessToken == '') {
            throw new Error("An access token is required to change your name.");
        }

        if (refreshToken == '') {
            throw Error("A refresh token is required to change your name.")
        }

        if (!isValidEmail(email)) {
            throw new Error("The email provided is not valid.");
        }

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
                email: email,
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

export const changeNickname = createAsyncThunk('user/changeNickname', async (nickname) => {
    try {
        const email = localStorage.getItem('email');
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (accessToken == '') {
            throw Error("An access token is required to change your nickname.")
        }

        if (refreshToken == '') {
            throw Error("An refresh token is required to change your nickname.")
        }

        if (!isValidEmail(email)) {
            throw new Error("The email provided is not valid.");
        }

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
                email: email,
                nicename: nickname
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const changeNicename = createAsyncThunk('user/changeNicename', async (nicename) => {
    try {
        const email = localStorage.getItem('email');
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (accessToken == '') {
            throw Error("An access token is required to change your nicename.")
        }

        if (refreshToken == '') {
            throw Error("An refresh token is required to change your nicename.")
        }

        if (!isValidEmail(email)) {
            throw new Error("The email provided is not valid.");
        }

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
                email: email,
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

export const addUserRole = createAsyncThunk('user/addUserRole', async ({ name, display_name }) => {
    try {
        const email = localStorage.getItem('email');
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (accessToken == '') {
            throw Error("An access token is required to add user role.")
        }

        if (refreshToken == '') {
            throw Error("An refresh token is required to add user role.")
        }

        if (!isValidEmail(email)) {
            throw new Error("The email provided is not valid.");
        }
        console.log(name);
        console.log(display_name);
        const response = await fetch(`${addUserRoleUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
                name: name,
                display_name: display_name
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const removeUserRole = createAsyncThunk('user/removeUserRole', async ({ name, display_name }) => {
    try {
        const email = localStorage.getItem('email');
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (accessToken == '') {
            throw Error("An access token is required to remove user role.")
        }

        if (refreshToken == '') {
            throw Error("An refresh token is required to remove user role.")
        }

        if (!isValidEmail(email)) {
            throw new Error("The email provided is not valid.");
        }

        const response = await fetch(`${removeUserRoleUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
                name: name,
                display_name: display_name
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const changePhone = createAsyncThunk('user/changePhone', async (phone) => {
    try {
        const email = localStorage.getItem('email');
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (accessToken == '') {
            throw Error("An access token is required to change your phone number.")
        }

        if (refreshToken == '') {
            throw Error("An refresh token is required to change your phone number.")
        }

        if (!isValidEmail(email)) {
            throw new Error("The email provided is not valid.");
        }

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
                email: email,
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

export const userSlice = createSlice({
    name: 'user',
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
                getUser.fulfilled, (state, action) => {
                    state.userLoading = false;
                    state.userError = '';
                    state.userSuccessMessage = action.payload.successMessage;
                    state.userErrorMessage = action.payload.errorMessage;
                    state.userStatusCode = action.payload.statusCode;
                    state.username = action.payload.username;
                    state.firstname = action.payload.firstname;
                    state.lastname = action.payload.lastname;
                    state.nickname = action.payload.nickname;
                    state.nicename = action.payload.nicename;
                    state.roles = action.payload.roles;
                    state.phone = action.payload.phone;
                })
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
                addUserRole.fulfilled, (state, action) => {
                    state.userLoading = false;
                    state.userError = '';
                    state.userSuccessMessage = action.payload.successMessage;
                    state.userErrorMessage = action.payload.errorMessage;
                    state.userStatusCode = action.payload.statusCode;
                    state.roles = action.payload.roles;
                })
            .addCase(
                removeUserRole.fulfilled, (state, action) => {
                    state.userLoading = false;
                    state.userError = '';
                    state.userSuccessMessage = action.payload.successMessage;
                    state.userErrorMessage = action.payload.errorMessage;
                    state.userStatusCode = action.payload.statusCode;
                    state.roles = action.payload.roles;
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
                getUser.pending,
                changeUsername.pending,
                changeName.pending,
                changeNickname.pending,
                changeNicename.pending,
                addUserRole.pending,
                removeUserRole.pending,
                changePhone.pending
            ), (state) => {
                state.userLoading = true;
                state.userError = null;
                state.userSuccessMessage = '';
                state.userErrorMessage = '';
                state.userStatusCode = '';
            })
            .addMatcher(isAnyOf(
                getUser.rejected,
                changeUsername.rejected,
                changeName.rejected,
                changeNickname.rejected,
                changeNicename.rejected,
                addUserRole.rejected,
                removeUserRole.rejected,
                changePhone.rejected
            ), (state, action) => {
                state.userLoading = false;
                state.userError = action.error;
                state.userErrorMessage = action.error.message;
                state.userStatusCode = action.error.code;
            });
    }
})

export default userSlice;

