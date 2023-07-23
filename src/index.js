import React from 'react';
import { createRoot } from 'react-dom';
import App from './App';

window.onload = function () {
  const thfw = document.getElementById('thfw');

  if (thfw) {
    createRoot(thfw).render(App);
  } else {
    console.log('THFW container not available');
  }
}; 