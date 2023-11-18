import { useState } from 'react';
import NavigationComponent from './components/NavigationLogin';
import { login } from '../utils/login';
import { displayStatus, displayStatusType } from '../utils/DisplayStatus';
import { signInEmailAndPassword } from '../controllers/usersSlice';

function LoginComponent() {
  const [Email, setEmail] = useState('');
  const [Password, setPassword] = useState('');
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState(
    'Enter your email and password to log in.'
  );

  const handleChange = (e) => {
    if (e.target.name === 'email') {
      setEmail(e.target.value);
    } else if (e.target.name === 'password') {
      setPassword(e.target.value);
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    dispatch(signInEmailAndPassword(Email, Password));
      // .then((response) => {
      //   setMessage(displayStatus(response));
      //   setMessageType(displayStatusType(response));
      // })
      // .then(() => {
      //   const urlParams = new URLSearchParams(window.location.search);
      //   const redirectTo = urlParams.get('redirectTo');

      //   setTimeout(() => {
      //     if (redirectTo === null) {
      //       window.location.href = '/dashboard';
      //     } else {
      //       window.location.href = redirectTo;
      //     }
      //   }, 5000);
      // });
  };

  return (
    <>
      <main className="login">
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
                    <h3>LOGIN</h3>
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

export default LoginComponent;
