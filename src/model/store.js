import { configureStore } from '@reduxjs/toolkit';

import { emailSlice } from '../controllers/emailSlice.js';
import { loginSlice } from '../controllers/loginSlice.js';
import { logoutSlice } from '../controllers/logoutSlice.js';
import { userSlice } from '../controllers/userSlice.js';
import { passwordSlice } from '../controllers/passwordSlice.js';
import { accountSlice } from '../controllers/accountSlice.js';
import { signupSlice } from '../controllers/signupSlice.js';
import { roleSlice } from '../controllers/roleSlice.js';

const store = configureStore({
    reducer: {
        login: loginSlice.reducer,
        logout: logoutSlice.reducer,
        account: accountSlice.reducer,
        email: emailSlice.reducer,
        user: userSlice.reducer,
        password: passwordSlice.reducer,
        signup: signupSlice.reducer,
        role: roleSlice.reducer
    }
});

export default store;