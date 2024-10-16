import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import NavigationLoginComponent from './components/NavigationLoginComponent';
import ForgotComponent from './components/ForgotComponent';
import StatusBarComponent from './components/StatusBarComponent';

function Forgot() {
  let page = 'forgot';

  const dispatch = useDispatch();

  const { passwordSuccessMessage, passwordErrorMessage, passwordStatusCode } =
    useSelector((state) => state.password);

  const [showStatusbar, setShowStatusBar] = useState('');
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState(
    'If you forgot your password, enter your username or email.'
  );

  useEffect(() => {
    if (passwordSuccessMessage) {
      const urlParams = new URLSearchParams(window.location.search);
      const redirectTo = urlParams.get('redirectTo');

      setTimeout(() => {
        if (redirectTo === null) {
          window.location.href = '/login';
        } else {
          window.location.href = redirectTo;
        }
      }, 5000);

      setMessageType('success');
      setMessage(passwordSuccessMessage);
    }
  }, [dispatch, passwordSuccessMessage]);

  useEffect(() => {
    if (passwordErrorMessage && passwordStatusCode != 403) {
      setMessageType('error');
      setMessage(passwordErrorMessage);
    }
  }, [dispatch, passwordErrorMessage]);

  useEffect(() => {
    if (message != '') {
      setShowStatusBar('modal-overlay');
      setTimeout(() => {
        setShowStatusBar('');
      }, 5000);
    }
  }, [message]);

  return (
    <>
      <main className="forgot">
        <NavigationLoginComponent page={page} />
        <ForgotComponent />

        <span className={showStatusbar}>
          {message !== '' && (
            <StatusBarComponent messageType={messageType} message={message} />
          )}
        </span>
      </main>
    </>
  );
}

export default Forgot;
