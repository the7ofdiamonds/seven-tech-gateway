import ReactDOM from 'react-dom';
import App from './App.jsx';

import './services/firebase/config';

const sevenTech = document.getElementById('seven_tech');

if (sevenTech) {
  ReactDOM.render(<React.Fragment><App /></React.Fragment>, sevenTech);
}
