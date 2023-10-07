import { configureStore } from '@reduxjs/toolkit';
import teamSlice from '../controllers/teamSlice';

const store = configureStore({
    reducer: {
        team: teamSlice.reducer,
    }
});

export default store;