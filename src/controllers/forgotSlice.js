import {
    sendPasswordResetEmail,
    getAuth
} from "firebase/auth";

const apiUrl = import.meta.env.VITE_BACKEND_URL ? import.meta.env.VITE_BACKEND_URL + "/forgot-password" : "/wp-json/seven-tech/v1/users/logout";

export const forgot = async (Email) => {
    const auth = getAuth();

    try {
        // Needs enpoint in the backend
        await sendPasswordResetEmail(auth, Email);
        return 'An email has been sent with a link to reset your password.';
    } catch (error) {
        const errorCode = error.code;
        const errorMessage = error.message;

        return `Error (${errorCode}): ${errorMessage}`;
    }
};