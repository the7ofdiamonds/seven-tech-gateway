import { configureStore } from '@reduxjs/toolkit';

import { contentSlice } from '../controllers/contentSlice';
import { usersSlice } from '../controllers/usersSlice.js';
import { teamSlice } from '../controllers/teamSlice';
import { scheduleSlice } from '../controllers/scheduleSlice.js';
import { founderSlice } from '../controllers/founderSlice.js';

const store = configureStore({
    reducer: {
        content: contentSlice.reducer,
        users: usersSlice.reducer,
        schedule: scheduleSlice.reducer,
        team: teamSlice.reducer,
        founder: founderSlice.reducer
    }
});

export default store;