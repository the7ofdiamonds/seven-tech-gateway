import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const apiUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/signup' : '/wp-json/thfw/users/v1/signup';

const initialState = {
    signupLoading: false,
    signupError: '',
    signupMessage: '',
    signupMessageType: '',
};

export const signup = createAsyncThunk('signup/signup', async (credentials) => {
    try {

        await fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": credentials.username,
                "email": credentials.email,
                "password": credentials.password,
                "confirmPassword": credentials.confirmPassword,
                "firstname": credentials.firstname,
                "lastname": credentials.lastname,
                "phone": credentials.phone,
                "location": credentials.location
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
        const errorCode = error.code;
        const errorMessage = error.message;

        return `Error (${errorCode}): ${errorMessage}`;
    }
});

export const signupSlice = createSlice({
    name: 'signup',
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
                state.signupLoading = false;
                state.signupError = '';
                state.signupMessage = action.payload.message;
                state.signupMessageType = action.payload.message_type;
                state.customToken = action.payload.custom_token;
            })
            .addMatcher(isAnyOf(
                signIn.pending,
            ), (state) => {
                state.signupLoading = true;
                state.signupError = null;
            })
            .addMatcher(isAnyOf(
                signIn.rejected,
            ),
                (state, action) => {
                    state.signupLoading = false;
                    state.signupError = action.error.stack;
                    state.signupMessageType = 'error';
                    state.signupMessage = action.error.message;
                });
    }
})

export default signupSlice;