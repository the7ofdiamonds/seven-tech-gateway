import { configureStore } from '@reduxjs/toolkit';

import { contentSlice } from '../controllers/contentSlice.js';
import { usersSlice } from '../controllers/usersSlice.js';
import { teamSlice } from '../controllers/teamSlice.js';
import { founderSlice } from '../controllers/founderSlice.js';

const store = configureStore({
    reducer: {
        content: contentSlice.reducer,
        users: usersSlice.reducer,
        team: teamSlice.reducer,
        founder: founderSlice.reducer
    }
});

export default store;