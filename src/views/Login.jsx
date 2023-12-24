import { useState } from 'react';
import { useDispatch } from 'react-redux';

import NavigationComponent from './components/NavigationLogin';

import { displayStatus, displayStatusType } from '../utils/DisplayStatus';

import { signInEmailAndPassword } from '../controllers/loginSlice';

function LoginComponent() {
  const [formData, setFormData] = useState({ email: '', password: '' });
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState(
    'Enter your email and password to log in.'
  );

  const dispatch = useDispatch();

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    dispatch(signInEmailAndPassword(formData))
    .then((response) => {
      console.log(response);
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
                      value={formData.email}
                      onChange={handleInputChange}
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
                      value={formData.password}
                      onChange={handleInputChange}
                      required
                    />
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td>
                    <button type="submit">
                      <h3>LOGIN</h3>
                    </button>
                  </td>
                </tr>
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
