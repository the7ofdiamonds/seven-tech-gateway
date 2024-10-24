import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidEmail } from '../utils/Validation';

const getUserUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/get' : "/wp-json/seven-tech/v1/user/get";

const addUserRoleUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/add-role' : "/wp-json/seven-tech/v1/user/roles/add";
const removeUserRoleUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/remove-role' : "/wp-json/seven-tech/v1/user/roles/remove";

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
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        if (accessToken == '') {
            throw Error("An access token is required to get user data.")
        }

        if (refreshToken == '') {
            throw Error("A refresh token is required to get user data.")
        }

        const response = await fetch(`${getUserUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            }
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
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        const response = await fetch(`${addUserRoleUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
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
            .addMatcher(isAnyOf(
                getUser.pending,
                addUserRole.pending,
                removeUserRole.pending
            ), (state) => {
                state.userLoading = true;
                state.userError = null;
                state.userSuccessMessage = '';
                state.userErrorMessage = '';
                state.userStatusCode = '';
            })
            .addMatcher(isAnyOf(
                getUser.rejected,
                addUserRole.rejected,
                removeUserRole.rejected
            ), (state, action) => {
                state.userLoading = false;
                state.userError = action.error;
                state.userErrorMessage = action.error.message;
                state.userStatusCode = action.error.code;
            });
    }
})

export default userSlice;

