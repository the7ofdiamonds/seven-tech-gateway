import { getAuth } from "firebase/auth";

import { firebaseAuth } from '../services/firebase/config.js';

export const logout = async () => {
    const auth = getAuth();

    try {
        await firebaseAuth.signOut();
        
        const response = await fetch('/wp-json/thfw/users/v1/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
        });

        return response.data;
    } catch (error) {
        console.error('Error:', error.message);
    }
};