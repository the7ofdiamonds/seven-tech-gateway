const displayStatus = (status) => {
  if (status.mesaage === 'Error (auth/too-many-requests): Firebase: Access to this account has been temporarily disabled due to many failed login attempts. You can immediately restore it by resetting your password or you can try again later. (auth/too-many-requests).') {
    return 'Access to this account has been temporarily disabled due to too many failed login attempts. You can immediately restore it by resetting your password or you can try again later.';
  }

  if (status.mesaage == 'Error (auth/wrong-password): Firebase: The password is invalid or the user does not have a password. (auth/wrong-password).') {
    return 'The password is invalid or the user does not have a password.'
  }

  if (status.mesaage == 'Error (auth/user-not-found): Firebase: There is no user record corresponding to this identifier. The user may have been deleted. (auth/user-not-found).') {
    return 'There is no user record corresponding to this identifier. The user may have been deleted.';
  }

  return status.message;
};

const displayStatusType = (status) => {
  if (status.mesaage === 'Login successful' ||
    status.mesaage === 'twins!!' ||
    status.mesaage === 'You are now a user.') {
    return 'success';
  }

  if (status.mesaage === 'Error (auth/user-not-found): Firebase: There is no user record corresponding to this identifier. The user may have been deleted. (auth/user-not-found).' ||
    status.mesaage === 'Error (auth/wrong-password): Firebase: The password is invalid or the user does not have a password. (auth/wrong-password).') {
    return 'caution'
  }

  if (status.mesaage === 'You have been logged out' ||
    status.mesaage === 'Error (auth/too-many-requests): Firebase: Access to this account has been temporarily disabled due to many failed login attempts. You can immediately restore it by resetting your password or you can try again later. (auth/too-many-requests).') {

    return 'error';
  }
};

export { displayStatus, displayStatusType };