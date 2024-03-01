import { configureStore } from '@reduxjs/toolkit';

import { contentSlice } from '../controllers/contentSlice.js';
import { usersSlice } from '../controllers/usersSlice.js';
import { teamSlice } from '../controllers/teamSlice.js';
import { founderSlice } from '../controllers/founderSlice.js';
import { loginSlice } from '../controllers/loginSlice.js';
import { logoutSlice } from '../controllers/logoutSlice.js';

const store = configureStore({
    reducer: {
        login: loginSlice.reducer,
        logout: logoutSlice.reducer,
        content: contentSlice.reducer,
        users: usersSlice.reducer,
        team: teamSlice.reducer,
        founder: founderSlice.reducer
    }
});

export default store;