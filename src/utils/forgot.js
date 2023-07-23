import {
    sendPasswordResetEmail,
    getAuth
} from "https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js";

export const forgot = async (Email) => {
    const auth = getAuth();

    try {
        await sendPasswordResetEmail(auth, Email);
        console.log('An email has been sent with a link to reset your password.');
    } catch (error) {
        console.log('This email has not been registered yet.', error);
    }
};