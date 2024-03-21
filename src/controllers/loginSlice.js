import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const apiUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL : "/wp-json/seven-tech/v1/users/login";

const initialState = {
    loginLoading: false,
    loginError: '',
    loginSuccessMessage: '',
    loginErrorMessage: '',
    username: '',
    name: '',
    email: '',
    userPhoto: '',
    accessToken: '',
    refreshToken: ''
};

export const updateUsername = (username) => {
    return {
        type: 'login/updateUsername',
        payload: username
    };
};

export const updateName = (displayName) => {
    return {
        type: 'login/updateName',
        payload: displayName
    };
};

export const updateEmail = (email) => {
    return {
        type: 'login/updateEmail',
        payload: email
    };
};

export const updateUserPhoto = (userPhoto) => {
    return {
        type: 'login/updateName',
        payload: userPhoto
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
                'Authentication': "Bearer " + localStorage.getItem('accessToken'),
                'refresh-token': localStorage.getItem('refreshToken'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "username": username,
                "password": password,
                "location": location
            })
        });
console.log("login function called");
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
        updateName: (state, action) => {
            state.name = action.payload;
            localStorage.setItem('name', action.payload);
        },
        updateUsername: (state, action) => {
            state.username = action.payload;
            localStorage.setItem('username', action.payload);
        },
        updateEmail: (state, action) => {
            state.email = action.payload;
            localStorage.setItem('email', action.payload);
        },
        updateUserPhoto: (state, action) => {
            state.userPhoto = action.payload;
            localStorage.setItem('userPhoto', action.payload);
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
                    state.loginErrorMessage = action.error;
                });
    }
})

export default loginSlice;