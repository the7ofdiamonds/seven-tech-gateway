import {
    createUserWithEmailAndPassword, getAuth
} from "firebase/auth";

export const signup = createAsyncThunk('signup/signup', async (User_Name, Email, Password) => {
    try {
        const auth = getAuth();

        await createUserWithEmailAndPassword(auth, Email, Password);

        const new_user_data = {
            'user_login': User_Name,
            'user_email': Email,
            'user_password': Password
        };

        await fetch('/wp-json/thfw/users/v1/signup', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(new_user_data)
        });

        if (!response.ok) {
            const errorData = await response.json();
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        const errorCode = error.code;
        const errorMessage = error.message;

        return `Error (${errorCode}): ${errorMessage}`;
    }
});