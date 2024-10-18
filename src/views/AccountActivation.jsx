import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';

import { activateAccount } from '../controllers/accountSlice';

import StatusBarComponent from './components/StatusBarComponent';

import { isValidEmail } from '../utils/Validation';

function AccountActivation() {
  const { emailEncoded, confirmationCode } = useParams();

  const email = emailEncoded.replace(/%40/g, '@');

  const dispatch = useDispatch();

  const { accountSuccessMessage, accountErrorMessage } = useSelector(
    (state) => state.account
  );

  const [message, setMessage] = useState(
    'Check your email for the confirmation code and link.'
  );
  const [messageType, setMessageType] = useState('');

  useEffect(() => {
    console.log(email);
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
    if (accountErrorMessage) {
      setMessage(accountErrorMessage);
      setMessageType('error');
    }
  }, [accountErrorMessage]);

  useEffect(() => {
    dispatch(activateAccount({ email, confirmationCode }));
  }, [email, confirmationCode]);

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

export default AccountActivation;
