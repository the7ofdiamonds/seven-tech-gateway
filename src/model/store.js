import { configureStore } from '@reduxjs/toolkit';

import { contentSlice } from '../controllers/contentSlice.js';
import { teamSlice } from '../controllers/teamSlice.js';
import { emailSlice } from '../controllers/emailSlice.js';
import { founderSlice } from '../controllers/founderSlice.js';
import { loginSlice } from '../controllers/loginSlice.js';
import { logoutSlice } from '../controllers/logoutSlice.js';
import { tokenSlice } from '../controllers/tokenSlice.js';
import { changeSlice } from '../controllers/changeSlice.js';
import { passwordSlice } from '../controllers/passwordSlice.js';
import { accountSlice } from '../controllers/accountSlice.js';
import { signupSlice } from '../controllers/signupSlice.js';

const store = configureStore({
    reducer: {
        login: loginSlice.reducer,
        logout: logoutSlice.reducer,
        account: accountSlice.reducer,
        content: contentSlice.reducer,
        team: teamSlice.reducer,
        email: emailSlice.reducer,
        founder: founderSlice.reducer,
        token: tokenSlice.reducer,
        change: changeSlice.reducer,
        password: passwordSlice.reducer,
        signup: signupSlice.reducer
    }
});

export default store;