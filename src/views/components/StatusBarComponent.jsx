import React from 'react';

function StatusBarComponent(props) {
  const { messageType, message } = props;

  return (
    <div className={`status-bar card ${messageType}`} id='status_bar'>
      <span>{message}</span>
    </div>
  );
}

export default StatusBarComponent;
