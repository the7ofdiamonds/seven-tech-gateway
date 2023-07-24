import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

import { logout } from '../utils/logout';
import { displayStatus, displayStatusType } from '../utils/DisplayStatus';

function LogOutComponent() {
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState('');

  const handleClick = () => {
    useEffect(() => {
      logout()
        .then((responseMessage) => {
          setMessage(responseMessage);
        })
        .then(() => {
          setTimeout(() => {
            window.location = '/';
          }, 10000);
        })
        .catch((error) => {
          console.error('Error occurred while logging out:', error);
          setMessage('Error occurred while logging out.');
          setMessageType('error');
        });
    }, []);

    useEffect(() => {
      displayStatus(message);
      setMessageType(displayStatusType(message));
    }, [message]);
  };

  return (
    <>
      <button onClick={handleClick()}>
        <h3>LOGOUT</h3>
      </button>

      {message !== '' && (
        <div className="status-bar card">
          <span className={`${messageType}`}>{message}</span>
        </div>
      )}
    </>
  );
}

export default LogOutComponent;
