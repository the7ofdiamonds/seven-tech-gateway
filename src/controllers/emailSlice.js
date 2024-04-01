import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';
import { isValidConfirmationCode, isValidEmail } from '../utils/Validation';

const veryEmailUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/verify-email' : "/wp-json/seven-tech/v1/users/verify-email";
// const addEmailUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/add-email' : "/wp-json/seven-tech/v1/users/add-email";
// const removeEmailUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + '/remove-email' : "/wp-json/seven-tech/v1/users/remove-email";

const initialState = {
    emailLoading: false,
    emailError: '',
    emailSuccessMessage: '',
    emailErrorMessage: '',
    emailStatusCode: ''
};

export const updateEmailSuccessMessage = () => {
    return {
        type: 'email/updateEmailSuccessMessage',
        payload: ''
    };
};

export const updateEmailErrorMessage = () => {
    return {
        type: 'email/updateEmailErrorMessage',
        payload: ''
    };
};

export const verifyEmail = createAsyncThunk('email/verifyEmail', async ({email, confirmationCode}) => {
    try {

        if (isValidConfirmationCode(confirmationCode) == false) {
            throw new Error("Confirmation Code is not valid.");
        }

        if (isValidEmail(email) == false) {
            throw new Error("Email is not valid.");
        }

        const response = await fetch(`${veryEmailUrl}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                confirmationCode: confirmationCode,
                email: email
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error)
        throw error;
    }
});

// Need a way to link multiple providers to one user
// export const addEmail = createAsyncThunk('email/addEmail', async (email) => {
//     try {
//         const accessToken = localStorage.getItem('access_token');

//         if (!accessToken) {
//             throw new Error("An access token is required to change your name.");
//         }

//         if (isValidEmail(email) == false) {
//             throw new Error("Email is not valid.");
//         }

//         const response = await fetch(`${addEmailUrl}`, {
//             method: 'POST',
//             headers: {
//                 'Authorization': "Bearer " + accessToken,
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify({
//                 "email": email
//             })
//         });

//         const responseData = await response.json();

//         return responseData;
//     } catch (error) {
//         console.error(error)
//         throw error;
//     }
// });

// export const removeEmail = createAsyncThunk('email/removeEmail', async (email) => {
//     try {
//         const accessToken = localStorage.getItem('access_token');

//         if (!accessToken) {
//             throw new Error("An access token is required to change your name.");
//         }

//         if (isValidEmail(email) == false) {
//             throw new Error("Email is not valid.");
//         }

//         const response = await fetch(`${removeEmailUrl}`, {
//             method: 'POST',
//             headers: {
//                 'Authorization': "Bearer " + accessToken,
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify({
//                 "email": email
//             })
//         });

//         const responseData = await response.json();

//         return responseData;
//     } catch (error) {
//         console.error(error)
//         throw error;
//     }
// });

export const emailSlice = createSlice({
    name: 'email',
    initialState,
    reducers: {
        updateEmailSuccessMessage: (state, action) => {
            state.emailSuccessMessage = action.payload;
        },
        updateEmailErrorMessage: (state, action) => {
            state.emailError = action.payload;
            state.emailErrorMessage = action.payload;
        }
    },
    extraReducers: (builder) => {
        builder
            .addMatcher(isAnyOf(
                verifyEmail.fulfilled,
                //  addEmail.fulfilled, 
                //  removeEmail.fulfilled
            ), (state, action) => {
                state.emailLoading = false;
                state.emailError = '';
                state.emailSuccessMessage = action.payload.successMessage;
                state.emailErrorMessage = action.payload.errorMessage;
                state.emailStatusCode = action.payload.statusCode;
            })
            .addMatcher(isAnyOf(
                verifyEmail.pending,
                // addEmail.pending,
                // removeEmail.pending
            ), (state) => {
                state.emailLoading = true;
                state.emailError = '';
                state.emailSuccessMessage = '';
                state.emailErrorMessage = '';
                state.emailStatusCode = '';
            })
            .addMatcher(isAnyOf(
                verifyEmail.rejected,
                // addEmail.rejected,
                // removeEmail.rejected
            ), (state, action) => {
                state.emailLoading = false;
                state.emailError = action.error;
                state.emailErrorMessage = action.error.message;
                state.emailStatusCode = action.error.code;
            });
    }
})

export default emailSlice;

