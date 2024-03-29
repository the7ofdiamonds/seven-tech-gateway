import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';

import { verifyEmail } from '../controllers/emailSlice';

import StatusBarComponent from './components/StatusBarComponent';

import { isValidEmail } from '../utils/Validation';

function VerifyEmail() {
  const { emailEncoded, confirmationCode } = useParams();

  const email = emailEncoded.replace(/%40/g, '@');

  const dispatch = useDispatch();

  const { emailSuccessMessage, emailErrorMessage, emailStatusCode } =
    useSelector((state) => state.email);

  const [message, setMessage] = useState(
    'Check your email for the confirmation code and link.'
  );
  const [messageType, setMessageType] = useState('');

  useEffect(() => {
    if (isValidEmail(email) != true) {
      setMessageType('error');
      setMessage('Email is not valid.');
    }
  }, [email]);

  useEffect(() => {
    if (emailSuccessMessage) {
      setMessage(emailSuccessMessage);
      setMessageType('success');
    }
  }, [emailSuccessMessage]);

  useEffect(() => {
    if (emailErrorMessage) {
      setMessage(emailErrorMessage);
      setMessageType('error');
    }
  }, [emailErrorMessage]);

  useEffect(() => {
    if (
      (email != '' || email != undefined) &&
      (confirmationCode != '' || confirmationCode != undefined)
    ) {
      dispatch(verifyEmail({ email, confirmationCode }));
    }
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

export default VerifyEmail;
