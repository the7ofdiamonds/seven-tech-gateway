import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const apiUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL : "/wp-json/seven-tech/v1/users/login";

const initialState = {
    loginLoading: false,
    loginError: '',
    loginMessage: '',
    loginMessageType: '',
    user_login: '',
    display_name: '',
    user_pass: '',
    user_email: '',
    first_name: '',
    last_name: '',
    user_id: '',
    accessToken: '',
    refreshToken: '',
    customToken: ''
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

export const signIn = createAsyncThunk('login/signIn', async ({ username, password }) => {
    try {

        const response = await fetch(`${apiUrl}/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
                "password": password,
                "location": "here"
            })
        });

        if (!response.ok) {
            const errorData = await response.json();
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

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
        updateAccessToken: (state, action) => {
            state.accessToken = action.payload;
        },
        updateRefreshToken: (state, action) => {
            state.refreshToken = action.payload;
        }
    },
    extraReducers: (builder) => {
        builder
            .addCase(signIn.fulfilled, (state, action) => {
                state.loginLoading = false;
                state.loginError = '';
                state.loginMessage = action.payload.message;
                state.loginMessageType = action.payload.message_type;
                state.customToken = action.payload.custom_token;
            })
            .addMatcher(isAnyOf(
                signIn.pending,
            ), (state) => {
                state.loginLoading = true;
                state.loginError = null;
            })
            .addMatcher(isAnyOf(
                signIn.rejected,
            ),
                (state, action) => {
                    state.loginLoading = false;
                    state.loginError = action.error.stack;
                    state.loginMessageType = 'error';
                    state.loginMessage = action.error.message;
                });
    }
})

export default loginSlice;