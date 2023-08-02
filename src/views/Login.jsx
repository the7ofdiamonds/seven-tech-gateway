import { useState, useEffect } from 'react';
import NavigationComponent from './Navigation';
import { login } from '../utils/login';
import { displayStatus, displayStatusType } from '../utils/DisplayStatus';

function LoginComponent() {
  const [Email, setEmail] = useState('');
  const [Password, setPassword] = useState('');
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState('Enter your email and password to log in.');

  const handleChange = (e) => {
    if (e.target.name === 'email') {
      setEmail(e.target.value);
    } else if (e.target.name === 'password') {
      setPassword(e.target.value);
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    await login(Email, Password)
      .then((response) => {
        setMessage(displayStatus(response));
        setMessageType(displayStatusType(response));
      })
      .then(() => {
        const urlParams = new URLSearchParams(window.location.search);
        const redirectTo = urlParams.get('redirectTo');

        setTimeout(() => {
          if (redirectTo === null) {
            window.location.href = '/dashboard';
          } else {
            window.location.href = redirectTo;
          }
        }, 5000);
      });
  };

  return (
    <>
      <NavigationComponent />
      <div className="login card">
        <form onSubmit={handleSubmit}>
          <table>
            <thead></thead>
            <tbody>
              <tr>
                <td>
                  <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    onChange={handleChange}
                    required
                  />
                </td>
              </tr>
              <tr>
                <td>
                  <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    onChange={handleChange}
                    required
                  />
                </td>
              </tr>
            </tbody>
            <tfoot>
              <td>
                <button type="submit">
                  <h3>LOG IN</h3>
                </button>
              </td>
            </tfoot>
          </table>
        </form>
      </div>

      {message !== '' && (
        <div className="status-bar card">
          <span className={`${messageType}`}>{message}</span>
        </div>
      )}
    </>
  );
}

export default LoginComponent;
