import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';

import { updatePassword } from '../controllers/changeSlice';
import {
  isValidConfirmationCode,
  isValidPassword,
  isValidUsername,
} from '../utils/Validation';

function PasswordRecovery() {
  const { username, confirmationCode } = useParams();

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
  
console.log(isValidPassword("1Test$22"));

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
  console.log(password);

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
    setPassword(e.target.value);
  };

  const handleChangeConfirmPassword = (e) => {
    setConfirmPassword(e.target.value);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (
      username &&
      confirmationCode &&
      isValidPassword(password) &&
      password === confirmPassword
    ) {
      dispatch(updatePassword({ username, confirmationCode, password }));
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

export default PasswordRecovery;
