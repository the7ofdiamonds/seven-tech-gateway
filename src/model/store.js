import { configureStore } from '@reduxjs/toolkit';

import { usersSlice } from '../controllers/usersSlice.js';
import { teamSlice } from '../controllers/teamSlice';
import { scheduleSlice } from '../controllers/scheduleSlice.js';

const store = configureStore({
    reducer: {
        users: usersSlice.reducer,
        schedule: scheduleSlice.reducer,
        team: teamSlice.reducer,
    }
});

export default store;