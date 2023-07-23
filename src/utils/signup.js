import {
    createUserWithEmailAndPassword,
    getAuth
} from "https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js";

export const signup = async (Email, Password) => {
    const auth = getAuth();

    try {
        await createUserWithEmailAndPassword(auth, Email, Password);
        console.log('You have access now.');
    } catch (error) {
        console.log('This email already exist.', error);
    }
};