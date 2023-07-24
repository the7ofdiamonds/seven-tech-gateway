import {
    sendPasswordResetEmail,
    getAuth
} from "firebase/auth";

export const forgot = async (Email) => {
    const auth = getAuth();

    try {
        await sendPasswordResetEmail(auth, Email);
        console.log('An email has been sent with a link to reset your password.');
    } catch (error) {
        console.log('This email has not been registered yet.', error);
    }
};