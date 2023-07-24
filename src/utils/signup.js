import {
    createUserWithEmailAndPassword, getAuth
} from "firebase/auth";

export const signup = async (Email, Password) => {
    const auth = getAuth();

    try {
        await createUserWithEmailAndPassword(auth, Email, Password);
        console.log('You have access now.');
    } catch (error) {
        console.log('This email already exist.', error);
    }
};