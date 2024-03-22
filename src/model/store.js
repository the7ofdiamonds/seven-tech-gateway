import { configureStore } from '@reduxjs/toolkit';

import { contentSlice } from '../controllers/contentSlice.js';
import { usersSlice } from '../controllers/usersSlice.js';
import { teamSlice } from '../controllers/teamSlice.js';
import { founderSlice } from '../controllers/founderSlice.js';
import { loginSlice } from '../controllers/loginSlice.js';
import { logoutSlice } from '../controllers/logoutSlice.js';
import { tokenSlice } from '../controllers/tokenSlice.js';
import { changeSlice } from '../controllers/changeSlice.js';

const store = configureStore({
    reducer: {
        login: loginSlice.reducer,
        logout: logoutSlice.reducer,
        content: contentSlice.reducer,
        users: usersSlice.reducer,
        team: teamSlice.reducer,
        founder: founderSlice.reducer,
        token: tokenSlice.reducer,
        change: changeSlice.reducer
    }
});

export default store;