import { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import { logout } from '../controllers/logoutSlice';

function LogOutComponent() {
  const dispatch = useDispatch();

  const { logoutSuccessMessage, logoutErrorMessage } =
    useSelector((state) => state.logout);

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

  const handleClick = () => {
    dispatch(logout())
      .then(() => {
        setTimeout(() => {
          window.location.href = '/';
        }, 5000);
      });
  };

  return (
    <>
      <main className="logout">
        <button onClick={handleClick}>
          <h3>LOG OUT</h3>
        </button>

        {message !== '' && (
          <div className={`status-bar card ${messageType}`}>
            <span>{message}</span>
          </div>
        )}
      </main>
    </>
  );
}

export default LogOutComponent;
