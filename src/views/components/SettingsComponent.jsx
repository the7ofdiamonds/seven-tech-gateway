import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import {
  changePassword,
  sendForgotPasswordEmail
} from '../../controllers/passwordSlice';
import {
  changeName,
  changePhone,
  changeUsername
} from '../../controllers/changeSlice';
// import { removeEmail } from '../../controllers/emailSlice';
import { logout, logoutAll } from '../../controllers/logoutSlice';
import {
  sendRemoveAccountEmail
} from '../../controllers/accountSlice';

import StatusBarComponent from '../components/StatusBarComponent';

function SettingsComponent() {
  const dispatch = useDispatch();

  const {
    changeLoading,
    changeError,
    changeSuccessMessage,
    changeErrorMessage,
    changeStatusCode,
  } = useSelector((state) => state.change);
  const {
    emailLoading,
    emailError,
    emailSuccessMessage,
    emailErrorMessage,
    emailStatusCode,
  } = useSelector((state) => state.email);
  const {
    passwordLoading,
    passwordError,
    passwordSuccessMessage,
    passwordErrorMessage,
    passwordStatusCode,
  } = useSelector((state) => state.password);
  const {
    logoutLoading,
    logoutError,
    logoutSuccessMessage,
    logoutErrorMessage,
  } = useSelector((state) => state.logout);
  const {
    accountLoading,
    accountError,
    accountSuccessMessage,
    accountErrorMessage,
    accountStatusCode,
    email,
    username,
    firstname,
    lastname,
    phone,
  } = useSelector((state) => state.account);

  const [firstName, setFirstNameChange] = useState(firstname);
  const [lastName, setLastNameChange] = useState(lastname);
  const [usernameChange, setUsernameChange] = useState(username);
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [phoneChange, setPhoneChange] = useState(phone);
  const [emailRemove, setEmailRemove] = useState('');

  const [showStatusbar, setShowStatusBar] = useState('');
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState('');

  useEffect(() => {
    if (accountLoading || changeLoading || emailLoading || passwordLoading) {
      setMessage('');
    }
  }, [dispatch, accountLoading, changeLoading, emailLoading, passwordLoading]);

  useEffect(() => {
    if (logoutSuccessMessage) {
      setMessageType('success');
      setMessage(logoutSuccessMessage);
    }
  }, [dispatch, logoutSuccessMessage]);

  useEffect(() => {
    if (changeSuccessMessage) {
      setMessageType('success');
      setMessage(changeSuccessMessage);
    }
  }, [dispatch, changeSuccessMessage]);

  useEffect(() => {
    if (emailSuccessMessage) {
      setMessageType('success');
      setMessage(emailSuccessMessage);
    }
  }, [dispatch, emailSuccessMessage]);

  useEffect(() => {
    if (passwordSuccessMessage) {
      setMessageType('success');
      setMessage(passwordSuccessMessage);
    }
  }, [dispatch, passwordSuccessMessage]);

  useEffect(() => {
    if (accountSuccessMessage) {
      setMessageType('success');
      setMessage(accountSuccessMessage);
    }
  }, [dispatch, accountSuccessMessage]);

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
    if (changeErrorMessage && changeStatusCode != 403) {
      setMessageType('error');
      setMessage(changeErrorMessage);
    }
  }, [dispatch, changeErrorMessage]);

  useEffect(() => {
    if (emailErrorMessage && emailStatusCode != 403) {
      setMessageType('error');
      setMessage(emailErrorMessage);
    }
  }, [dispatch, emailErrorMessage]);

  useEffect(() => {
    if (passwordErrorMessage && passwordStatusCode != 403) {
      setMessageType('error');
      setMessage(passwordErrorMessage);
    }
  }, [dispatch, passwordErrorMessage]);

  useEffect(() => {
    if (accountErrorMessage && accountStatusCode != 403) {
      setMessageType('error');
      setMessage(accountErrorMessage);
    }
  }, [dispatch, accountErrorMessage]);

  useEffect(() => {
    if (
      (changeStatusCode != 403 ||
        emailStatusCode != 403 ||
        passwordStatusCode != 403 ||
        accountStatusCode != 403) &&
      message != ''
    ) {
      setShowStatusBar('modal-overlay');
      setTimeout(() => {
        setShowStatusBar('');
      }, 3000);
    }
  }, [
    dispatch,
    changeStatusCode,
    emailStatusCode,
    passwordStatusCode,
    accountStatusCode,
    message,
  ]);

  const handleChangeNameChangeFirst = (e) => {
    e.preventDefault();

    if (e.target.name == 'firstname') {
      setFirstNameChange(e.target.value);
    }
  };

  const handleChangeNameChangeLast = (e) => {
    e.preventDefault();

    if (e.target.name == 'lastname') {
      setLastNameChange(e.target.value);
    }
  };

  const handleChangeName = (e) => {
    e.preventDefault();

    if (firstName !== '' || lastName !== '') {
      dispatch(changeName({ firstName, lastName })).then((response) => {
        if (response.payload.statusCode == 201) {
          dispatch(updateAccountFirstName(response.payload.firstname));
          dispatch(updateAccountLastName(response.payload.lastname));
        }
      });
    }
  };

  {
    /* Create Change Title (roles) */
  }

  const handleChangeUsernameChange = (e) => {
    e.preventDefault();

    if (e.target.name == 'username') {
      setUsernameChange(e.target.value);
    }
  };

  const handleChangeUsername = (e) => {
    e.preventDefault();

    if (usernameChange != '') {
      dispatch(changeUsername(usernameChange));
    }
  };

  const handleChangePasswordChange = (e) => {
    e.preventDefault();

    if (e.target.name == 'password') {
      setPassword(e.target.value);
    }

    if (e.target.name == 'confirmPassword') {
      setConfirmPassword(e.target.value);
    }
  };

  const handleChangePassword = (e) => {
    e.preventDefault();

    if (
      password == confirmPassword &&
      password != '' &&
      confirmPassword != ''
    ) {
      dispatch(changePassword({ password, confirmPassword }));
    }
  };

  const handleForgotPassword = (e) => {
    e.preventDefault();

    if (email != '' || localStorage.getItem('email') != '') {
      dispatch(
        sendForgotPasswordEmail(email ? email : localStorage.getItem('email'))
      );
    } else {
      setMessageType('error');
      setMessage('An email is required to reset password.');
    }
  };

  const handleChangePhoneChange = (e) => {
    e.preventDefault();

    if (e.target.name == 'phone') {
      setPhoneChange(e.target.value);
    }
  };

  const handleChangePhone = (e) => {
    e.preventDefault();

    if (phoneChange != '') {
      dispatch(changePhone(phoneChange));
    }
  };

  // const handleRemoveEmailChange = (e) => {
  //   e.preventDefault();

  //   if (e.target.name == 'email') {
  //     setEmailRemove(e.target.value);
  //   }
  // };

  // const handleRemoveEmail = (e) => {
  //   e.preventDefault();

  //   if (emailRemove != '') {
  //     dispatch(removeEmail(emailRemove));
  //   }
  // };

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

  const handleRemoveAccount = () => {
    if (email != '' || localStorage.getItem('email') != '') {
      dispatch(
        sendRemoveAccountEmail(email ? email : localStorage.getItem('email'))
      );
    }else {
      setMessageType('error');
      setMessage('An email is required to remove your account.');
    }
  };

  return (
    <>
      <table className="settings">
        <thead>
          <th>
            <h2>Settings</h2>
          </th>
        </thead>

        <tbody>
          <tr>
            <td>
              <form action="">
                <table>
                  <thead></thead>
                  <tbody>
                    <tr className="change-name">
                      <input
                        type="text"
                        name="firstname"
                        placeholder="First Name"
                        value={firstName}
                        onChange={handleChangeNameChangeFirst}
                      />

                      <input
                        type="text"
                        name="lastname"
                        placeholder="Last Name"
                        value={lastName}
                        onChange={handleChangeNameChangeLast}
                      />

                      <button onClick={handleChangeName}>
                        <h3>Change Name</h3>
                      </button>
                    </tr>

                    <tr>{/* Create Change Title (roles) */}</tr>

                    <tr className="change-username">
                      <input
                        type="text"
                        name="username"
                        placeholder="Username"
                        value={usernameChange}
                        onChange={handleChangeUsernameChange}
                      />

                      <button onClick={handleChangeUsername}>
                        <h3>Change Username</h3>
                      </button>
                    </tr>

                    <tr className="change-phone">
                      <input
                        type="text"
                        name="phone"
                        placeholder="Phone Number"
                        value={phoneChange}
                        onChange={handleChangePhoneChange}
                      />

                      <button onClick={handleChangePhone}>
                        <h3>Change Phone</h3>
                      </button>
                    </tr>

                    {/* Needs send email */}

                    <tr className="change-password">
                      <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        value={password}
                        onChange={handleChangePasswordChange}
                      />

                      <input
                        type="password"
                        name="confirmPassword"
                        placeholder="Confirm Password"
                        value={confirmPassword}
                        onChange={handleChangePasswordChange}
                      />

                      <button onClick={handleChangePassword}>
                        <h3>Change Password</h3>
                      </button>
                    </tr>

                    {/* <tr className="remove-email">
                      <input
                        type="text"
                        name="email"
                        placeholder="Email"
                        value={emailRemove}
                        onChange={handleRemoveEmailChange}
                      />

                      <button onClick={handleRemoveEmail}>
                        <h3>Remove Email</h3>
                      </button>
                    </tr> */}
                  </tbody>
                </table>
              </form>
            </td>
          </tr>
        </tbody>

        <tfoot>
          <tr className="forgot-password">
            <button onClick={handleForgotPassword}>
              <h3>FORGOT PASSWORD</h3>
            </button>
          </tr>

          <tr className="logout">
            <button onClick={handleLogout}>
              <h3>LOG OUT</h3>
            </button>

            {logoutAllUrl != null && (
              <button onClick={handleLogoutAll}>
                <h3>LOG OUT ALL</h3>
              </button>
            )}
          </tr>

          <tr className="remove-account">
            <button onClick={handleRemoveAccount}>
              <h3>REMOVE ACCOUNT</h3>
            </button>
          </tr>

          <span className={showStatusbar}>
            {message !== '' && (
              <StatusBarComponent messageType={messageType} message={message} />
            )}
          </span>
        </tfoot>
      </table>
    </>
  );
}

export default SettingsComponent;
