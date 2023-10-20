import { useState, useEffect } from 'react';

import { logout } from '../utils/logout';
import { displayStatus } from '../utils/DisplayStatus';

function LogOutComponent() {
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState('');

  const handleClick = () => {
    logout()
      .then((responseMessage) => {
        setMessage(responseMessage);
        setTimeout(() => {
          window.location.href = '/';
        }, 5000);
      })
      .catch((error) => {
        console.error('Error occurred while logging out:', error);
        setMessage('Error occurred while logging out.');
        setMessageType('error');
      });
  };

  useEffect(() => {
    if (message !== '') {
      displayStatus(message);
      setMessageType('error');
    }
  }, [message]);

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
