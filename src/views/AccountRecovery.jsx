import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';

import { recoverAccount } from '../controllers/accountSlice';

import { isValidEmail } from '../utils/Validation';

import StatusBarComponent from './components/StatusBarComponent';

function AccountRecovery() {
  const { emailEncoded, userActivationKey } = useParams();

  const email = emailEncoded.replace(/%40/g, '@');

  const dispatch = useDispatch();

  const { accountSuccessMessage, accountErrorMessage, accountStatusCode } =
    useSelector((state) => state.account);

  const [message, setMessage] = useState('');
  const [messageType, setMessageType] = useState('');

  useEffect(() => {
    if (isValidEmail(email) != true) {
      setMessageType('error');
      setMessage('Email is not valid.');
    }
  }, [email]);

  useEffect(() => {
    if (accountSuccessMessage) {
      setMessage(accountSuccessMessage);
      setMessageType('success');
    }
  }, [accountSuccessMessage]);

  useEffect(() => {
    if (accountStatusCode == 200) {
      setTimeout(() => {
        window.location.href = '/login';
      }, 5000);
    }
  }, [accountStatusCode]);

  useEffect(() => {
    if (accountErrorMessage) {
      setMessage(accountErrorMessage);
      setMessageType('error');
    }
  }, [accountErrorMessage]);

  useEffect(() => {
    if (isValidEmail(email)) {
      dispatch(recoverAccount({ email, userActivationKey }));
    }
  }, [dispatch, email, userActivationKey]);

  return (
    <>
      <main>
        {message !== '' && (
          <StatusBarComponent messageType={messageType} message={message} />
        )}
      </main>
    </>
  );
}

export default AccountRecovery;
