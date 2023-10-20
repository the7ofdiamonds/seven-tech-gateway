import { useState, useEffect } from 'react';

import NavigationComponent from './components/NavigationLogin';

import { displayStatus, displayStatusType } from '../utils/DisplayStatus';
import { signup } from '../utils/signup';

function SignUpComponent() {
  const [UserName, setUserName] = useState('');
  const [Email, setEmail] = useState('');
  const [Password, setPassword] = useState('');
  const [ConfirmPassword, setConfirmPassword] = useState('');
  const [message, setMessage] = useState(
    'Enter the username, email, and password of your choice to sign up.'
  );
  const [messageType, setMessageType] = useState('');

  useEffect(() => {
    if (
      Password !== '' &&
      ConfirmPassword !== '' &&
      Password === ConfirmPassword
    ) {
      const msg = 'You have successfully entered your password twice.';
      setMessage(displayStatus(msg));
      setMessageType(displayStatusType(msg));
    } else if (Password !== '' && Password !== ConfirmPassword) {
      const msg = 'You have not entered your password twice.';
      setMessage(displayStatus(msg));
      setMessageType(displayStatusType(msg));
    }
  }, [Password, ConfirmPassword]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    signup(UserName, Email, Password)
      .then((response) => {
        setMessage(displayStatus(response));
        setMessageType(displayStatusType(response));
      })
      .then(() => {
        setTimeout(() => {
          window.location.href = '/login';
        }, 5000);
      })
      .catch((error) => {
        console.log(error.message);
        setMessage(displayStatus(error.message));
        setMessageType(displayStatusType(error.message));
      });
  };

  const handleChange = (e) => {
    if (e.target.name === 'user-name') {
      setUserName(e.target.value);
    } else if (e.target.name === 'email') {
      setEmail(e.target.value);
    } else if (e.target.name === 'password') {
      setPassword(e.target.value);
    } else if (e.target.name === 'confirm-password') {
      setConfirmPassword(e.target.value);
    }
  };

  return (
    <>
      <main className="signup">
        <NavigationComponent />

        <div className="login card">
          <form>
            <table>
              <thead></thead>
              <tbody>
                <tr>
                  <td>
                    <input
                      type="text"
                      name="user-name"
                      placeholder="User Name"
                      onChange={handleChange}
                      required
                    />
                  </td>
                </tr>
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
                <tr>
                  <td>
                    <input
                      type="password"
                      name="confirm-password"
                      placeholder="Confirm Password"
                      onChange={handleChange}
                      required
                    />
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <td>
                  <button type="submit" onClick={handleSubmit}>
                    <h3>SIGN UP</h3>
                  </button>
                </td>
              </tfoot>
            </table>
          </form>
        </div>

        {message !== '' && (
          <div className={`status-bar card ${messageType}`}>
            <span>{message}</span>
          </div>
        )}
      </main>
    </>
  );
}

export default SignUpComponent;
