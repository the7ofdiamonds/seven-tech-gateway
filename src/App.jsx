import { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import { Provider } from 'react-redux';

import store from './model/store.js';

import LoadingComponent from './loading/LoadingComponent';

const About = lazy(() => import('./views/About'));
const Schedule = lazy(() => import('./views/Schedule.jsx'));
const Login = lazy(() => import('./views/Login'));
const LogOut = lazy(() => import('./views/Logout'));
const SignUp = lazy(() => import('./views/Signup'));
const Forgot = lazy(() => import('./views/Forgot'));
const Dashboard = lazy(() => import('./views/Dashboard'));
const Founders = lazy(() => import('./views/Founders'));
const Founder = lazy(() => import('./views/Founder'));
const Team = lazy(() => import('./views/Team'));
const TeamMember = lazy(() => import('./views/TeamMember'));

function App() {
  return (
    <>
      <Provider store={store}>
        <Router>
          <Suspense fallback={<LoadingComponent />}>
            <Routes>
              <Route path="/" element={<About />} />
              <Route path="/about" element={<About />} />
              <Route path="/schedule" element={<Schedule />} />
              <Route path="/login" element={<Login />} />
              <Route path="/logout" element={<LogOut />} />
              <Route path="/signup" element={<SignUp />} />
              <Route path="/forgot" element={<Forgot />} />
              <Route path="/Dashboard" element={<Dashboard />} />
              <Route path="/founders" element={<Founders />} />
              <Route path="/founders/:founder" element={<Founder />} />
              <Route path="/team" element={<Team />} />
              <Route path="/team/:teammember" element={<TeamMember />} />
            </Routes>
          </Suspense>
        </Router>
      </Provider>
    </>
  );
}

export default App;
