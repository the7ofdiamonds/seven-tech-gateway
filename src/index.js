import { lazy, Suspense } from 'react';
import ReactDOM from 'react-dom';
import App from './App';

import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { Provider } from 'react-redux';
import store from './model/store.js';

import './services/firebase/config';

const Team = lazy(() => import('./views/Team'));

window.onload = function () {
  const thfw = document.getElementById('thfw');

  if (thfw) {
    ReactDOM.render(<App />, thfw);
  }
};

const thfwUsers = document.getElementById('thfw_users');
if (thfwUsers) {
  ReactDOM.createRoot(thfwUsers).render(
    <React.StrictMode>
      <Provider store={store}>
        <Router>
          <Routes>
            <Route path="/" element={<Team />} />
            <Route path="/about" element={<Team />} />
          </Routes>
        </Router>
      </Provider>
    </React.StrictMode>
  );
}
