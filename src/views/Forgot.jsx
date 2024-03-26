import { useState } from 'react';

import NavigationComponent from './components/NavigationLogin';

import { displayStatus } from '../utils/DisplayStatus';

import { forgotPassword } from '../controllers/passwordSlice';

function ForgotComponent() {
  const [email, setEmail] = useState('');
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState(
    'If you forgot your password, enter your username or email.'
  );

  const handleSubmit = async (e) => {
    e.preventDefault();
    forgotPassword(email).then(() => {
      const urlParams = new URLSearchParams(window.location.search);
      const redirectTo = urlParams.get('redirectTo');

      setTimeout(() => {
        if (redirectTo === null) {
          window.location.href = '/login';
        } else {
          window.location.href = redirectTo;
        }
      }, 5000);

      setMessage(displayStatus(`Check your inbox and spam for ${Email}`));
      setMessageType('info');
    });
  };

  const handleChange = (e) => {
    if (e.target.name === 'email') {
      setEmail(e.target.value);
    }
  };

  return (
    <>
      <main className="forgot">
        <NavigationComponent />
        <div className="login card">
          <form>
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
              </tbody>
              <tfoot>
                <td>
                  <button type="submit" onClick={handleSubmit}>
                    <h3>RESET</h3>
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

export default ForgotComponent;
