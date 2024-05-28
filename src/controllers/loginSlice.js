import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidEmail, isValidPassword } from '../utils/Validation';

const loginUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL : "/wp-json/seven-tech/v1/authentication/login";

const initialState = {
    loginLoading: false,
    loginError: '',
    loginSuccessMessage: '',
    loginErrorMessage: '',
    username: '',
    displayName: '',
    email: '',
    profileImage: '',
    accessToken: '',
    refreshToken: ''
};

export const updateAccountID = (accountID) => {
    return {
        type: 'login/updateAccountID',
        payload: accountID
    };
};

export const updateUsername = (username) => {
    return {
        type: 'login/updateUsername',
        payload: username
    };
};

export const updateDisplayName = (displayName) => {
    return {
        type: 'login/updateDisplayName',
        payload: displayName
    };
};

export const updateEmail = (email) => {
    return {
        type: 'login/updateEmail',
        payload: email
    };
};

export const updateProfileImage = (profileImage) => {
    return {
        type: 'login/updateProfileImage',
        payload: profileImage
    };
};

export const updateAccessToken = (access_token) => {
    return {
        type: 'login/updateAccessToken',
        payload: access_token
    };
};

export const updateRefreshToken = (refresh_token) => {
    return {
        type: 'login/updateRefreshToken',
        payload: refresh_token
    };
};

export const login = createAsyncThunk('login/login', async ({ email, password, location }) => {
    try {
        const accessToken = localStorage.getItem('access_token');
        const refreshToken = localStorage.getItem('refresh_token');

        const response = await fetch(`${loginUrl}`, {
            method: 'POST',
            headers: {
                'Authorization': "Bearer " + accessToken,
                'Refresh-Token': refreshToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
                password: password,
                location: location
            })
        });

        const responseData = await response.json();
console.log(response);
        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const loginSlice = createSlice({
    name: 'login',
    initialState,
    reducers: {
        updateAccountID: (state, action) => {
            state.id = action.payload;
            localStorage.setItem('id', action.payload);
        },
        updateDisplayName: (state, action) => {
            state.displayName = action.payload;
            localStorage.setItem('display_name', action.payload);
        },
        updateUsername: (state, action) => {
            state.username = action.payload;
            localStorage.setItem('username', action.payload);
        },
        updateEmail: (state, action) => {
            state.email = action.payload;
            localStorage.setItem('email', action.payload);
        },
        updateProfileImage: (state, action) => {
            state.profileImage = action.payload;
            localStorage.setItem('profile_image', action.payload);
        },
        updateAccessToken: (state, action) => {
            state.accessToken = action.payload;
            localStorage.setItem('access_token', action.payload);
        },
        updateRefreshToken: (state, action) => {
            state.refreshToken = action.payload;
            localStorage.setItem('refresh_token', action.payload);
        }
    },
    extraReducers: (builder) => {
        builder
            .addCase(login.fulfilled, (state, action) => {
                state.loginLoading = false;
                state.loginError = '';
                state.loginSuccessMessage = action.payload.successMessage;
                state.loginErrorMessage = action.payload.errorMessage;
                state.loginStatusCode = action.payload.statusCode;
                state.id = action.payload.authenticatedAccount.id;
                state.email = action.payload.authenticatedAccount.email;
                state.username = action.payload.authenticatedAccount.username;
                state.refreshToken = action.payload.authenticatedAccount.refreshToken;
                state.accessToken = action.payload.authenticatedAccount.accessToken;
                state.profileImage = action.payload.authenticatedAccount.photoURL;
            })
            .addCase(
                login.pending, (state) => {
                    state.loginLoading = true;
                    state.loginError = '';
                    state.loginSuccessMessage = '';
                    state.loginErrorMessage = '';
                    state.loginStatusCode = '';
                })
            .addCase(login.rejected, (state, action) => {
                state.loginLoading = false;
                state.loginError = action.error;
                state.loginErrorMessage = action.error.message;
            });
    }
})

export default loginSlice;