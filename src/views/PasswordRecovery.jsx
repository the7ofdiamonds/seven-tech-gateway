import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';

import { updatePassword } from '../controllers/passwordSlice';

import {
  isValidConfirmationCode,
  isValidEmail,
  isValidPassword
} from '../utils/Validation';

import StatusBarComponent from './components/StatusBarComponent';

function PasswordRecovery() {
  const { emailEncoded, confirmationCode } = useParams();

  const email = emailEncoded.replace(/%40/g, '@');

  const dispatch = useDispatch();

  const {
    passwordSuccessMessage,
    passwordErrorMessage,
    passwordStatusCode
  } = useSelector((state) => state.password);

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

  useEffect(() => {
    if (passwordStatusCode != 403 && message != '') {
      setShowStatusBar('modal-overlay');
      setTimeout(() => {
        setShowStatusBar(true);
      }, 3000);
    }
  }, [passwordStatusCode, message]);

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
    if (
      isValidEmail(email) &&
      isValidConfirmationCode(confirmationCode) &&
      isValidPassword(password) &&
      password === confirmPassword
    ) {
      dispatch(
        updatePassword({ email, password, confirmPassword, confirmationCode })
      );
    }
  };

  return (
    <>
      <section>
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
                      name="confirmPassword"
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
                    <button type="submit" onClick={handleSubmit}>
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
      </section>
    </>
  );
}

export default PasswordRecovery;
