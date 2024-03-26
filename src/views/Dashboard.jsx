import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import { changePassword, forgotPassword } from '../controllers/passwordSlice';
import {
  changeName,
  changePhone,
  changeUsername,
} from '../controllers/changeSlice';
import { removeEmail } from '../controllers/emailSlice';
import { logout, logoutAllUrl, logoutAll } from '../controllers/logoutSlice';
import {
  removeAccount,
  updateAccountFirstName,
  updateAccountLastName,
} from '../controllers/accountSlice';
import LoginComponent from '../views/Login';

function Dashboard() {
  const dispatch = useDispatch();
  const { profileImage, displayName } = useSelector((state) => state.login);

  const profileImg = profileImage
    ? profileImage
    : localStorage.getItem('profile_image');
  const usersDisplayName = displayName
    ? displayName
    : localStorage.getItem('display_name');

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

  const [firstNameChange, setFirstNameChange] = useState(firstname);
  const [lastNameChange, setLastNameChange] = useState(lastname);
  const [usernameChange, setUsernameChange] = useState(username);
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [phoneChange, setPhoneChange] = useState(phone);
  const [emailRemove, setEmailRemove] = useState('');
  const [showLogin, setShowLogin] = useState(false);
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState('');

  useEffect(() => {
    if (
      changeStatusCode == 403 ||
      emailStatusCode == 403 ||
      passwordStatusCode == 403 ||
      accountStatusCode == 403
    ) {
      setShowLogin(true);
    }
  }, [
    dispatch,
    changeStatusCode,
    emailStatusCode,
    passwordStatusCode,
    accountStatusCode,
  ]);

  useEffect(() => {
    if (changeLoading) {
      setMessage('');
    }
  }, [dispatch, changeLoading]);

  useEffect(() => {
    if (emailLoading) {
      setMessage('');
    }
  }, [dispatch, emailLoading]);

  useEffect(() => {
    if (passwordLoading) {
      setMessage('');
    }
  }, [dispatch, passwordLoading]);

  useEffect(() => {
    if (accountLoading) {
      setMessage('');
    }
  }, [dispatch, accountLoading]);

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
    if (changeErrorMessage) {
      setMessageType('error');
      setMessage(changeErrorMessage);
    }
  }, [dispatch, changeErrorMessage]);

  useEffect(() => {
    if (emailErrorMessage) {
      setMessageType('error');
      setMessage(emailErrorMessage);
    }
  }, [dispatch, emailErrorMessage]);

  useEffect(() => {
    if (passwordErrorMessage) {
      setMessageType('error');
      setMessage(passwordErrorMessage);
    }
  }, [dispatch, passwordErrorMessage]);

  useEffect(() => {
    if (accountErrorMessage) {
      setMessageType('error');
      setMessage(accountErrorMessage);
    }
  }, [dispatch, accountErrorMessage]);

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

    if (firstNameChange !== '' || lastNameChange !== '') {
      dispatch(changeName({ firstNameChange, lastNameChange })).then(
        (response) => {
          if (response.payload.statusCode == 201) {
            dispatch(updateAccountFirstName(response.payload.firstname));
            dispatch(updateAccountLastName(response.payload.lastname));
          }
        }
      );
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
      dispatch(forgotPassword(email ? email : localStorage.getItem('email')));
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

  const handleRemoveEmailChange = (e) => {
    e.preventDefault();

    if (e.target.name == 'email') {
      setEmailRemove(e.target.value);
    }
  };

  const handleRemoveEmail = (e) => {
    e.preventDefault();

    if (emailRemove != '') {
      dispatch(removeEmail(emailRemove));
    }
  };

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
    dispatch(removeAccount());
  };

  return (
    <>
      <section className="dashboard">
        <h2 className="title">Dashboard</h2>
        <div>
          <div>
            <img src={`${profileImg}`} alt="" />
          </div>
          <span>{usersDisplayName}</span>
        </div>

        <table>
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
                          value={firstNameChange}
                          onChange={handleChangeNameChangeFirst}
                        />

                        <input
                          type="text"
                          name="lastname"
                          placeholder="Last Name"
                          value={lastNameChange}
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

                      <tr className="forgot-password">
                        <button onClick={handleForgotPassword}>
                          <h3>Forgot Password</h3>
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

                      <tr className="remove-email">
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
                      </tr>
                    </tbody>
                  </table>
                </form>
              </td>
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
          </tbody>

          <tfoot>
            {message !== '' && (
              <div className={`status-bar card ${messageType}`}>
                <span>{message}</span>
              </div>
            )}
          </tfoot>
        </table>
      </section>
      {/* {showLogin && ( */}
        <section className="modal-overlay">
          <LoginComponent />
        </section>
      {/* )} */}
    </>
  );
}

export default Dashboard;
