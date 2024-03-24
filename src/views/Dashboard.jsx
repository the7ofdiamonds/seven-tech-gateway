import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import {
  changeName,
  changeUsername,
  changePhone,
} from '../controllers/changeSlice';
import { changePassword, forgotPassword } from '../controllers/passwordSlice';
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

  const { changeName, changePhone, changeUsername } = useSelector(
    (state) => state.change
  );
  const { removeEmail } = useSelector((state) => state.email);
  const { changePassword } = useSelector((state) => state.password);
  const { logoutSuccessMessage, logoutErrorMessage } = useSelector(
    (state) => state.logout
  );

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

  const handleChangeName = () => {
    dispatch(changeName());
  };
  const firstname = 'Jamel';
  const lastname = 'Lyons';

  {
    /* Create Change Title (roles) */
  }

  const handleChangeUsername = () => {
    dispatch(changeUsername());
  };
  const username = 'TestUser';

  const handleChangePassword = () => {
    dispatch(changePassword());
  };

  const handleForgotPassword = (e) => {
    e.preventDefault();
    if (email != '' && localStorage.getItem('email') != '') {
      dispatch(forgotPassword(email ? email : localStorage.getItem('email')));
    } else {
      setMessageType('error');
      setMessage('An email is required to reset password.');
    }
  };

  const handleChangePhone = () => {
    dispatch(changePhone());
  };
  const phone = 7186172583;

  const handleRemoveEmail = () => {
    dispatch(removeEmail());
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
                          value={firstname}
                          onChange={handleChangeName}
                        />

                        <input
                          type="text"
                          name="lastname"
                          placeholder="Last Name"
                          value={lastname}
                          onChange={handleChangeName}
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
                          value={username}
                          onChange={handleChangeUsername}
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
                          value={''}
                          onChange={handleChangePassword}
                        />

                        <input
                          type="password"
                          name="confirmPassword"
                          placeholder="Confirm Password"
                          value={''}
                          onChange={handleChangePassword}
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
                          value={phone}
                          onChange={handleChangePhone}
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
                          value={email}
                          onChange={handleRemoveEmail}
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
