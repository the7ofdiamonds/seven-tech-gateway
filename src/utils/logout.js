import axios from 'axios';
import {
    getAuth
} from "https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js";

export const logout = async () => {
    const auth = getAuth();

    try {
        auth.signOut;
        const response = await axios.post('/wp-json/thfw/v1/logout');
        console.log(response.data);
        return response.data;
    } catch (error) {
        console.error('Error:', error.message);
    }
};