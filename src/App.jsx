import { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

// Components
const LoginComponent = lazy(() => import('./views/Login'));
const LogOutComponent = lazy(() => import('./views/Logout'));
const SignUpComponent = lazy(() => import('./views/Signup'));
const ForgotComponent = lazy(() => import('./views/Forgot'));

// Loading fallback component
function LoadingFallback() {
  return <div>Loading...</div>;
}

function App() {
  return (
    <>
      <Router>
        <Suspense fallback={<LoadingFallback />}>
          <Routes>
            <Route path="/login" element={<LoginComponent />} />
            <Route path="/logout" element={<LogOutComponent />} />
            <Route path="/signup" element={<SignUpComponent />} />
            <Route path="/forgot" element={<ForgotComponent />} />
          </Routes>
        </Suspense>
      </Router>
    </>
  );
}

export default App;