import { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import { Provider } from 'react-redux';

import store from './model/store.js';

import LoadingComponent from './loading/LoadingComponent';

const About = lazy(() => import('./views/About.jsx'));
const Login = lazy(() => import('./views/Login.jsx'));
const LogOut = lazy(() => import('./views/Logout.jsx'));
const SignUp = lazy(() => import('./views/Signup.jsx'));
const Forgot = lazy(() => import('./views/Forgot.jsx'));
const Dashboard = lazy(() => import('./views/Dashboard.jsx'));
const Founders = lazy(() => import('./views/Founders.jsx'));
const Founder = lazy(() => import('./views/Founder.jsx'));
const Team = lazy(() => import('./views/Team.jsx'));
const TeamMember = lazy(() => import('./views/TeamMember.jsx'));

function App() {
  return (
    <>
      <Provider store={store}>
        <Router>
          <Suspense fallback={<LoadingComponent />}>
            <Routes>
              <Route path="/" element={<About />} />
              <Route path="/about" element={<About />} />
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
