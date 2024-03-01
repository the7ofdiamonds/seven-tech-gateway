import { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import { displayStatus } from '../utils/DisplayStatus';

import { logout, signout } from '../controllers/logoutSlice';

function LogOutComponent() {
  const dispatch = useDispatch();

  const { logoutMessage, logoutMessageType, display_name, firebaseUserID } =
    useSelector((state) => state.logout);

  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState('');

  useEffect(() => {
    if (logoutMessage && logoutMessageType) {
      setMessageType(logoutMessageType);
      setMessage(logoutMessage);
    }
  }, [logoutMessage, logoutMessageType]);

  const handleClick = () => {
    dispatch(logout())
      // .then(() => {
      //   dispatch(signout());
      // })
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
