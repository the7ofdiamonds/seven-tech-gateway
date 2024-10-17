import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import { logout, logoutAll } from '../../controllers/logoutSlice';

import StatusBarComponent from './StatusBarComponent';

function AuthComponent() {
  const dispatch = useDispatch();

  const {
    logoutLoading,
    logoutError,
    logoutSuccessMessage,
    logoutErrorMessage,
  } = useSelector((state) => state.logout);

  useEffect(() => {
    if (logoutSuccessMessage) {
      setMessageType('success');
      setMessage(logoutSuccessMessage);
    }
  }, [dispatch, logoutSuccessMessage]);

  useEffect(() => {
    if (logoutErrorMessage) {
      setMessageType('error');
      setMessage(logoutErrorMessage);
    }
  }, [dispatch, logoutErrorMessage]);

  useEffect(() => {
    if (logoutErrorMessage) {
      setMessageType('error');
      setMessage(logoutErrorMessage);
    }
  }, [dispatch, logoutErrorMessage]);

  useEffect(() => {
    if (message != '') {
      setShowStatusBar('modal-overlay');
      setTimeout(() => {
        setShowStatusBar('');
      }, 3000);
    }
  }, [dispatch, message]);

  const [showStatusBar, setShowStatusBar] = useState('');
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState('');

  const handleLogout = () => {
    dispatch(logout()).then(() => {
      setTimeout(() => {
        window.location.href = '/';
      }, 5000);
    });
  };

  const handleLogoutAll = () => {
    if (logoutAllUrl != null) {
      dispatch(logoutAll()).then(() => {
        setTimeout(() => {
          window.location.href = '/';
        }, 5000);
      });
    }
  };

  return (
    <>
      <main className="auth">

        <span className="logout">
          <button onClick={handleLogout}>
            <h3>LOG OUT</h3>
          </button>

          <button onClick={handleLogoutAll}>
            <h3>LOG OUT ALL</h3>
          </button>
        </span>

        <span className={showStatusBar}>
          {message != '' && (
            <StatusBarComponent messageType={messageType} message={message} />
          )}
        </span>
      </main>
    </>
  );
}

export default AuthComponent;
