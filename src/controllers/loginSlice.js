import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidEmail, isValidPassword } from '../utils/Validation';

const loginUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL : "/wp-json/seven-tech/v1/authentication/login";

const initialState = {
    loginLoading: false,
    loginError: '',
    loginSuccessMessage: '',
    loginErrorMessage: '',
    id: '',
    username: '',
    email: '',
    profileImage: '',
    accessToken: '',
    refreshToken: ''
};

export const updateAccountID = (id) => {
    return {
        type: 'login/updateAccountID',
        payload: id
    };
};

export const updateEmail = (email) => {
    return {
        type: 'login/updateEmail',
        payload: email
    };
};

export const updateUsername = (username) => {
    return {
        type: 'login/updateUsername',
        payload: username
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

        const emailIsValid = isValidEmail(email);

        if (!emailIsValid) {
            throw Error('Email entered is not valid.')
        }

        const passwordIsValid = isValidPassword(password);

        if (!passwordIsValid) {
            throw Error('Password entered is not valid.')
        }

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
        updateEmail: (state, action) => {
            state.email = action.payload;
            localStorage.setItem('email', action.payload);
        },
        updateUsername: (state, action) => {
            state.username = action.payload;
            localStorage.setItem('username', action.payload);
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
                state.id = action.payload.statusCode == 200 ? action.payload.authenticatedAccount.id : '';
                state.email = action.payload.statusCode == 200 ? action.payload.authenticatedAccount.email : '';
                state.username = action.payload.statusCode == 200 ? action.payload.authenticatedAccount.username : '';
                state.profileImage = action.payload.statusCode == 200 ? action.payload.authenticatedAccount.profile_image : '';
                state.refreshToken = action.payload.statusCode == 200 ? action.payload.authenticatedAccount.refresh_token : '';
                state.accessToken = action.payload.statusCode == 200 ? action.payload.authenticatedAccount.access_token : '';
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