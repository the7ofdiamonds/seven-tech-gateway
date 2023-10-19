import { lazy, Suspense } from 'react';
import ReactDOM from 'react-dom';
import App from './App';

import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { Provider } from 'react-redux';
import store from './model/store.js';

import './services/firebase/config';

const LoadingComponent = lazy(() => import('./loading/LoadingComponent.jsx'));
const ScheduleComponent = lazy(() => import('./views/Schedule.jsx'));
const Founders = lazy(() => import('./views/Founders'));
const Founder = lazy(() => import('./views/Founder'));
const Team = lazy(() => import('./views/Team'));
const TeamMember = lazy(() => import('./views/TeamMember'));

window.onload = function () {
  const thfw = document.getElementById('thfw');

  if (thfw) {
    ReactDOM.render(<App />, thfw);
  }
};

const sevenTeam = document.getElementById('seven_tech_team');
if (sevenTeam) {
  ReactDOM.createRoot(sevenTeam).render(
    <React.StrictMode>
      <Provider store={store}>
        <Router>
          <Routes>
            <Route path="/team" element={<Team />} />
            <Route path="/team/:team" element={<TeamMember />} />
          </Routes>
        </Router>
      </Provider>
    </React.StrictMode>
  );
}

const sevenFounders = document.getElementById('seven_tech_founder');
if (sevenFounders) {
  ReactDOM.createRoot(sevenFounders).render(
    <React.StrictMode>
      <Provider store={store}>
        <Router>
          <Routes>
            <Route path="/" element={<Founders />} />
            <Route path="/about" element={<Founders />} />
            <Route path="/founders" element={<Founders />} />
            <Route path="/founders/:founder" element={<Founder />} />
          </Routes>
        </Router>
      </Provider>
    </React.StrictMode>
  );
}


const orbScheduleContainer = document.getElementById('orb_schedule');
if (orbScheduleContainer) {
  ReactDOM.createRoot(orbScheduleContainer).render(
    <React.StrictMode>
      <Provider store={store}>
        <Router>
          <Suspense fallback={<LoadingComponent />}>
            <Routes>
              <Route path="/" element={<ScheduleComponent />} />
              <Route path="/about" element={<ScheduleComponent />} />
              <Route path="/schedule" element={<ScheduleComponent />} />
            </Routes>
          </Suspense>
        </Router>
      </Provider>
    </React.StrictMode>
  );
}
