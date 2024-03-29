import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';

import { updatePassword } from '../controllers/passwordSlice';
import {
  isValidConfirmationCode,
  isValidEmail,
  isValidPassword
} from '../utils/Validation';

function RemoveAcount() {
  const { emailEncoded, confirmationCode } = useParams();

  const email = emailEncoded.replace(/%40/g, '@');

  const dispatch = useDispatch();

  const {
    changeLoading,
    changeError,
    changeSuccessMessage,
    changeErrorMessage,
  } = useSelector((state) => state.change);

  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [message, setMessage] = useState(
    'Enter your preferred password twice.'
  );
  const [messageType, setMessageType] = useState('');

  useEffect(() => {
    if (isValidEmail(email) != true) {
      setMessageType('error');
      setMessage("Email is not valid.");
    }
  }, [email]);

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
    if (password != '' && isValidPassword(password) == false) {
      setMessage('Password is not valid.');
      setMessageType('error');
    }
  }, [password]);

  useEffect(() => {
    if (
      password != '' &&
      confirmPassword != '' &&
      !isValidPassword(password) &&
      password != confirmPassword
    ) {
      setMessage('Passwords do not match.');
      setMessageType('error');
    }
  }, [password, confirmPassword]);

  useEffect(() => {
    if (changeSuccessMessage) {
      setMessage(changeSuccessMessage);
      setMessageType('success');
    }
  }, [changeSuccessMessage]);

  useEffect(() => {
    if (changeErrorMessage) {
      setMessage(changeErrorMessage);
      setMessageType('error');
    }
  }, [changeErrorMessage]);

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
                    {message !== '' && (
                      <div className={`status-bar card ${messageType}`}>
                        <span>{message}</span>
                      </div>
                    )}
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

export default RemoveAcount;
