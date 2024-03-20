import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const apiUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL : "/wp-json/seven-tech/v1/users/login";

const initialState = {
    loginLoading: false,
    loginError: '',
    loginSuccessMessage: '',
    loginErrorMessage: '',
    username: '',
    accessToken: '',
    refreshToken: ''
};

export const updateUsername = (username) => {
    return {
        type: 'login/updateUsername',
        payload: username
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

export const login = createAsyncThunk('login/login', async ({ username, password, location }) => {
    try {

        const response = await fetch(`${apiUrl}/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
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
        updateUsername: (action) => {
            localStorage.setItem('display_name', action.payload);
        },
        updateAccessToken: (action) => {
            localStorage.setItem('access_token', action.payload);
        },
        updateRefreshToken: (action) => {
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
                state.username = action.payload.username;
                state.refreshToken = action.payload.refreshToken;
                state.accessToken = action.payload.accessToken;
            })
            .addMatcher(isAnyOf(
                login.pending,
            ), (state) => {
                state.loginLoading = true;
                state.loginError = null;
                state.loginSuccessMessage = null;
                state.loginErrorMessage = null;
            })
            .addMatcher(isAnyOf(
                login.rejected,
            ),
                (state, action) => {
                    state.loginLoading = false;
                    state.loginError = action.error;
                    state.loginErrorMessage = action.error.errorMessage;
                });
    }
})

export default loginSlice;