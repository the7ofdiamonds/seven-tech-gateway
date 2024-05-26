import { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import { logout } from '../controllers/logoutSlice';

import StatusBarComponent from './components/StatusBarComponent';

function LogOutComponent() {
  const dispatch = useDispatch();

  const { logoutSuccessMessage, logoutErrorMessage, logoutError, logoutStatusCode } = useSelector(
    (state) => state.logout
  );

  const [showStatusbar, setShowStatusBar] = useState('');
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState('');

  useEffect(() => {
    if (logoutSuccessMessage) {
      setMessageType('success');
      setMessage(logoutSuccessMessage);
    }
  }, [logoutSuccessMessage]);

  useEffect(() => {
    if (logoutErrorMessage) {
      setMessageType('error');
      setMessage(logoutErrorMessage);
    }
  }, [logoutErrorMessage]);

  useEffect(() => {
    if (logoutError) {
      setMessageType('error');
      setMessage(logoutError.message);
    }
  }, [logoutError]);

  // useEffect(() => {
  //   if (logoutStatusCode == 200) {
  //     setTimeout(() => {
  //       window.location.href = '/';
  //     }, 5000);
  //   }
  // }, [logoutStatusCode]);

  useEffect(() => {
    if (message != '') {
      setShowStatusBar('modal-overlay');
      setTimeout(() => {
        setShowStatusBar('');
      }, 5000);
    }
  }, [message]);

  const handleClick = () => {
    dispatch(logout());
  };

  return (
    <>
      <main className="logout">
        <button onClick={handleClick}>
          <h3>LOG OUT</h3>
        </button>

        <span className={showStatusbar}>
          {message !== '' && (
            <StatusBarComponent messageType={messageType} message={message} />
          )}
        </span>
      </main>
    </>
  );
}

export default LogOutComponent;
