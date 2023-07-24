export const displayStatus = (status) => {
  return status;
};

export const displayStatusType = (status) => {
  if (status === 'You have been logged in') {
    return 'success';
  }

  if (status === 'You have been logged out') {
    return 'error';
  }
};
