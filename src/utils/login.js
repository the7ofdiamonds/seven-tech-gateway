import axios from 'axios';
import {
    browserSessionPersistence,
    setPersistence,
    signInWithEmailAndPassword,
    getAuth
} from "firebase/auth";

import { projectAuth } from '../services/firebase/config.js';

export const login = async (Email, Password) => {
const auth = getAuth();

    try {
        await signInWithEmailAndPassword(auth, Email, Password);
        await setPersistence(auth, browserSessionPersistence);

        projectAuth.onAuthStateChanged(async (user) => {
            if (user) {
                user.getIdToken().then(async (token) => {
                    const data = { 'idToken': token, 'user_password': Password };
                    await axios.post('/wp-json/thfw/users/v1/login', data)
                        .then(() => {
                            sessionStorage.setItem('idToken', token)
                        })
                        .then(() => {
                            const redirectTo = new URLSearchParams(location.search).get(
                                'redirectTo'
                            );

                            if (redirectTo) {
                                window.location = `${redirectTo}`;
                            } else {
                                window.location = '/';
                            }
                        });
                });
            }
        });
    } catch (error) {
        const errorCode = error.code;
        const errorMessage = error.message;
        console.error(`Error (${errorCode}): ${errorMessage}`);
    }
};