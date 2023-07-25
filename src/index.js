import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';

import './services/firebase/config';

window.onload = function () {
  const thfw = document.getElementById('thfw');

  if (thfw) {
    ReactDOM.render(<App />, thfw);
  } else {
    console.log('THFW container not available');
  }
};
