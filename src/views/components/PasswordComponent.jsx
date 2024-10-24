import React, { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import { changePassword } from '../../controllers/passwordSlice';

import { isValidPassword } from '../../utils/Validation';

import StatusBarComponent from '../components/StatusBarComponent';

function PasswordComponent() {
  const dispatch = useDispatch();

  const { passwordSuccessMessage, passwordErrorMessage, passwordStatusCode } =
    useSelector((state) => state.password);

  const { loginStatusCode } = useSelector((state) => state.login);

  const [showLogin, setShowLogin] = useState(false);

  useEffect(() => {
    if (loginStatusCode == 200) {
      setShowLogin(false);
    }
  }, [loginStatusCode]);

  useEffect(() => {
    if (passwordStatusCode == 403) {
      setShowLogin(true);
    }
  }, [passwordStatusCode]);

  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [showStatusbar, setShowStatusBar] = useState(false);
  const [message, setMessage] = useState(
    'Enter your preferred password twice.'
  );
  const [messageType, setMessageType] = useState('');

  useEffect(() => {
    if (
      password != '' &&
      confirmPassword != '' &&
      password === confirmPassword
    ) {
      setMessage('You have entered your password twice.');
      setMessageType('success');
    }
  }, [password, confirmPassword]);

  useEffect(() => {
    if (
      password != '' &&
      confirmPassword != '' &&
      password != confirmPassword
    ) {
      setMessage('Passwords do not match.');
      setMessageType('error');
    }
  }, [password, confirmPassword]);

  useEffect(() => {
    if (passwordSuccessMessage) {
      setMessage(passwordSuccessMessage);
      setMessageType('success');
    }
  }, [passwordSuccessMessage]);

  useEffect(() => {
    if (passwordErrorMessage) {
      setMessage(passwordErrorMessage);
      setMessageType('error');
    }
  }, [passwordErrorMessage]);

  const handleChangePassword = (e) => {
    if (e.target.name == 'password') {
      setPassword(e.target.value);
    }
  };

  const handleChangeConfirmPassword = (e) => {
    if (e.target.name == 'confirmPassword') {
      setConfirmPassword(e.target.value);
    }
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    if (isValidPassword(password) && password === confirmPassword) {
      dispatch(changePassword({ password, confirmPassword }));
    }
  };

  return (
    <>
      <main>
        <form action="">
          <table>
            <thead></thead>
            <tbody>
              <tr>
                <td>
                  <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    onChange={handleChangePassword}
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
                    onChange={handleChangeConfirmPassword}
                    required
                  />
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td>
                  <button
                    type="submit"
                    onClick={handleSubmit}
                    id="change_password_btn">
                    <h3>CONFIRM</h3>
                  </button>
                </td>
              </tr>
              <tr>
                <td>
                  <span className={showStatusbar}>
                    {message != '' && (
                      <StatusBarComponent
                        messageType={messageType}
                        message={message}
                      />
                    )}
                  </span>
                </td>
              </tr>
            </tfoot>
          </table>
        </form>
      </main>

      {showLogin && (
        <div className="modal-overlay">
          <main className="login">
            <LoginComponent />
          </main>
        </div>
      )}
    </>
  );
}

export default PasswordComponent;
