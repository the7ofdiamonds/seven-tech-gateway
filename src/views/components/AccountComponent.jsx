import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import { lockAccount } from '../../controllers/accountSlice';
import { getUser } from '../../controllers/userSlice';

import StatusBarComponent from './StatusBarComponent';

function AccountComponent() {
  const dispatch = useDispatch();

  const {
    accountLoading,
    accountError,
    accountSuccessMessage,
    accountErrorMessage,
    accountStatusCode,
    email,
  } = useSelector((state) => state.account);

  const { loginStatusCode } = useSelector((state) => state.login);

  const [showLogin, setShowLogin] = useState(false);

  useEffect(() => {
    if (loginStatusCode == 200) {
      setShowLogin(false);
    }
  }, [loginStatusCode]);

  useEffect(() => {
    dispatch(getUser());
  }, [dispatch]);

  useEffect(() => {
    if (accountLoading) {
      setMessage('');
    }
  }, [dispatch, accountLoading]);

  useEffect(() => {
    if (accountSuccessMessage) {
      setMessageType('success');
      setMessage(accountSuccessMessage);
    }
  }, [dispatch, accountSuccessMessage]);

  useEffect(() => {
    if (accountErrorMessage && accountStatusCode != 403) {
      setMessageType('error');
      setMessage(accountErrorMessage);
    }
  }, [dispatch, accountErrorMessage]);

  useEffect(() => {
    if (accountStatusCode != 403 && message != '') {
      setShowStatusBar('modal-overlay');
      setTimeout(() => {
        setShowStatusBar('');
      }, 3000);
    }
  }, [dispatch, accountStatusCode, message]);

  useEffect(() => {
    if (accountStatusCode == 200) {
      setTimeout(() => {
        window.location.href = '/';
      }, 5000);
    }
  }, [accountStatusCode]);

  useEffect(() => {
    if (accountStatusCode == 403) {
      setShowLogin(true);
    }
  }, [accountStatusCode]);

  const [showStatusBar, setShowStatusBar] = useState('');
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState('');

  const handleLockAccount = () => {
    if (email != '' || localStorage.getItem('email') != '') {
      dispatch(lockAccount(email ? email : localStorage.getItem('email')));
    } else {
      setMessageType('error');
      setMessage('An email is required to lock your account.');
    }
  };

  return (
    <>
      <main className="account">
        <span className="lock-account">
          <button onClick={handleLockAccount} id="lock_account_btn">
            <h3>LOCK ACCOUNT</h3>
          </button>
        </span>

        <span className={showStatusBar}>
          {message != '' && (
            <StatusBarComponent messageType={messageType} message={message} />
          )}
        </span>
      </main>

      {showLogin && (
        <div className="modal-overlay">
          <main className="login">
            <LoginComponent />
          </main>
        </div>
      )}
    </>
  );
}

export default AccountComponent;
