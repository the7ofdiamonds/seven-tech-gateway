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
import { removeAccount } from '../controllers/accountSlice';
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
  } = useSelector((state) => state.change);
  const { emailLoading, emailError, emailSuccessMessage, emailErrorMessage } =
    useSelector((state) => state.email);
  const {
    passwordLoading,
    passwordError,
    passwordSuccessMessage,
    passwordErrorMessage,
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
  } = useSelector((state) => state.account);

  const firstname = 'Jamel';
  const lastname = 'Lyons';
  const [firstNameChange, setFirstNameChange] = useState(firstname);
  const [lastNameChange, setLastNameChange] = useState(lastname);
  const username = 'TestUser';
  const [usernameChange, setUsernameChange] = useState(username);
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const phone = 7186172583;
  const [phoneChange, setPhoneChange] = useState(phone);
  const [emailRemove, setEmailRemove] = useState('');
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState('');

  useEffect(() => {
    if (logoutSuccessMessage != '') {
      setMessageType('success');
      setMessage(logoutSuccessMessage);
    }

    if (changeSuccessMessage != '') {
      setMessageType('success');
      setMessage(changeSuccessMessage);
    }

    if (passwordSuccessMessage != '') {
      setMessageType('success');
      setMessage(passwordSuccessMessage);
    }

    if (accountSuccessMessage != '') {
      setMessageType('success');
      setMessage(accountSuccessMessage);
    }
  }, [
    dispatch,
    changeSuccessMessage,
    passwordSuccessMessage,
    logoutSuccessMessage,
    accountSuccessMessage,
  ]);

  useEffect(() => {
    if (logoutErrorMessage != '') {
      setMessageType('error');
      setMessage(logoutErrorMessage);
    }

    if (changeErrorMessage != '') {
      setMessageType('error');
      setMessage(changeErrorMessage);
    }

    if (passwordErrorMessage != '') {
      setMessageType('error');
      setMessage(passwordErrorMessage);
    }

    if (accountErrorMessage != '') {
      setMessageType('error');
      setMessage(accountErrorMessage);
    }
  }, [
    dispatch,
    changeErrorMessage,
    passwordErrorMessage,
    logoutErrorMessage,
    accountErrorMessage,
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

    if (firstNameChange != '' || lastNameChange != '') {
      dispatch(changeName({ firstNameChange, lastNameChange }));
    }
  };

  {
    /* Create Change Title (roles) */
  }

  const handleChangeUsernameChange = (e) => {
    e.preventDefault();

    setUsernameChange(usernameChange);
  };

  const handleChangeUsername = (e) => {
    e.preventDefault();

    dispatch(changeUsername(usernameChange));
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

    if (password == confirmPassword) {
      dispatch(changePassword());
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

    if (phoneChange != 'confirmPassword' || phoneChange != undefined) {
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

    if (emailRemove != '' || emailRemove != undefined) {
      dispatch(removeEmail(emailRemove));
    }
  };
  const email = 'jamel.c.lyons@gmail.com';

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
      {/* Login pop up */}
      {/* <LoginComponent /> */}
    </>
  );
}

export default Dashboard;
