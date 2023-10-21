import ReactDOM from 'react-dom';
import App from './App';

import './services/firebase/config';

const sevenTech = document.getElementById('seven_tech');

if (sevenTech) {
  ReactDOM.render(<App />, sevenTech);
}
