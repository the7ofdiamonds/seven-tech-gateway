import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidEmail } from '../utils/Validation';

const loginUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL : "/wp-json/seven-tech/v1/users/login";

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

export const login = createAsyncThunk('login/login', async ({ identity, password, location }) => {
    try {

        var email = '';
        var username = '';

        if (isValidEmail(identity)) {
            var email = identity;
        }

        if (isValidUsername(identity)) {
            var username = identity;
        }

        if (isValidEmail(identity) == false && isValidUsername(identity) == false) {
            throw new Error("A valid email or username is required to login.");
        }

        const response = await fetch(`${loginUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
                "email": email,
                "password": password,
                "location": location
            })
        });

        const responseData = await response.json();
        
        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

export const loginSlice = createSlice({
    name: 'login',
    initialState,
    reducers: {
        updateDisplayName: (state, action) => {
            console.log(action.payload);
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
            console.log(action.payload);
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
                state.username = action.payload.username;
                state.refreshToken = action.payload.refreshToken;
                state.accessToken = action.payload.accessToken;
            })
            .addMatcher(isAnyOf(
                login.pending
            ), (state) => {
                state.loginLoading = true;
                state.loginError = '';
                state.loginSuccessMessage = '';
                state.loginErrorMessage = '';
                state.loginStatusCode = '';
            })
            .addMatcher(isAnyOf(
                login.rejected
            ),
                (state, action) => {
                    state.loginLoading = false;
                    state.loginError = action.error;
                    state.loginErrorMessage = action.error.message;
                    state.loginStatusCode = action.payload.statusCode;
                });
    }
})

export default loginSlice;