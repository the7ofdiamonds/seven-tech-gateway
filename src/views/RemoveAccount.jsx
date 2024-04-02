import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';

import {
  isValidConfirmationCode,
  isValidEmail,
  isValidPassword,
} from '../utils/Validation';

import { removeAccount } from '../controllers/accountSlice';

import StatusBarComponent from './components/StatusBarComponent';

function RemoveAcount() {
  const { emailEncoded, confirmationCode } = useParams();

  const dispatch = useDispatch();

  const { accountSuccessMessage, accountErrorMessage, accountStatusCode } =
    useSelector((state) => state.account);

  const [email, setEmail] = useState(emailEncoded.replace(/%40/g, '@'));
  const [password, setPassword] = useState('');
  const [showStatusbar, setShowStatusBar] = useState('');
  const [message, setMessage] = useState('');
  const [messageType, setMessageType] = useState('');

  useEffect(() => {
    if (email == '' || email == undefined) {
      setMessageType('error');
      setMessage('Email is not valid.');
    }

    if (isValidEmail(email) != true) {
      setMessageType('error');
      setMessage('Enter your email to remove your account.');
    }
  }, [email]);

  useEffect(() => {
    if (password == '' || password == undefined) {
      setMessage('Enter your password to remove account.');
      setMessageType('error');
    }
  }, [password]);

  useEffect(() => {
    if (accountSuccessMessage) {
      setMessage(accountSuccessMessage);
      setMessageType('success');
    }
  }, [accountSuccessMessage]);

  useEffect(() => {
    if (accountErrorMessage) {
      console.log(accountErrorMessage);

      setMessage(accountErrorMessage);
      setMessageType('error');
    }
  }, [accountErrorMessage]);

  useEffect(() => {
    if (message != '') {
      setShowStatusBar('modal-overlay');
      setTimeout(() => {
        setShowStatusBar('');
      }, 5000);
    }
  }, [message]);
  
  const handleChangeEmail = (e) => {
    e.preventDefault();

    setEmail(e.target.value);
  };

  const handleChangePassword = (e) => {
    e.preventDefault();

    setPassword(e.target.value);
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    if (
      isValidEmail(email) &&
      isValidConfirmationCode(confirmationCode) &&
      isValidPassword(password)
    ) {
      dispatch(removeAccount({ email, password, confirmationCode }));
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
                    type="text"
                    name="email"
                    placeholder="Email"
                    onChange={handleChangeEmail}
                    value={email}
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
                    onChange={handleChangePassword}
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
                    {message !== '' && (
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
    </>
  );
}

export default RemoveAcount;
