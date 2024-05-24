import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import { changePassword } from '../../controllers/passwordSlice';
import {
  changeUsername,
  changeName,
  changeNickname,
  changeNicename,
  changePhone,
} from '../../controllers/changeSlice';
import { logout, logoutAll, logoutAllUrl } from '../../controllers/logoutSlice';
import { lockAccount } from '../../controllers/accountSlice';

import StatusBarComponent from './StatusBarComponent';

function SettingsComponent() {
  const dispatch = useDispatch();

  const {
    changeLoading,
    changeError,
    changeSuccessMessage,
    changeErrorMessage,
    changeStatusCode,
  } = useSelector((state) => state.user);
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

  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [usernameChange, setUsernameChange] = useState(username);
  const [firstName, setFirstNameChange] = useState(firstname);
  const [lastName, setLastNameChange] = useState(lastname);
  const [nicknameChange, setNicknameChange] = useState(nickname);
  const [nicenameChange, setNicenameChange] = useState(nicename);
  const [phoneChange, setPhoneChange] = useState(phone);

  const [showStatusBar, setShowStatusBar] = useState('');
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

  const updatePassword = (e) => {
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

  const updateUsername = (e) => {
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

  const updateFirstName = (e) => {
    e.preventDefault();

    if (e.target.name == 'firstname') {
      setFirstNameChange(e.target.value);
    }
  };

  const updateLastName = (e) => {
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

  const updateNickname = (e) => {
    e.preventDefault();

    if (e.target.name == 'nickname') {
      setNicknameChange(e.target.value);
    }
  };

  const handleChangeNickname = (e) => {
    e.preventDefault();

    if (nicknameChange != '') {
      dispatch(changeNickname(nicknameChange));
    }
  };

  const updateNicename = (e) => {
    e.preventDefault();

    if (e.target.name == 'nicename') {
      setNicenameChange(e.target.value);
    }
  };

  const handleChangeNicename = (e) => {
    e.preventDefault();

    if (nicenameChange != '') {
      dispatch(changeNicename(nicenameChange));
    }
  };

  {
    /* Create Change Title (roles) */
  }

  const updatePhone = (e) => {
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

  const handleLockAccount = () => {
    if (email != '' || localStorage.getItem('email') != '') {
      dispatch(lockAccount(email ? email : localStorage.getItem('email')));
    } else {
      setMessageType('error');
      setMessage('An email is required to lock your account.');
    }
  };

  return (
    <>
      <main className="settings">
        <h2>Settings</h2>

        <span className="change-password">
          <input
            className="input-password"
            type="password"
            name="password"
            placeholder="Password"
            value={password}
            onChange={updatePassword}
          />

          <input
            className="input-password"
            type="password"
            name="confirmPassword"
            placeholder="Confirm Password"
            value={confirmPassword}
            onChange={updatePassword}
          />

          <div className="action">
            <button onClick={handleChangePassword}>
              <h3>Change Password</h3>
            </button>
          </div>
        </span>

        <span className="change-username">
          <input
            className="input-username"
            type="text"
            name="username"
            placeholder="Username"
            value={usernameChange}
            onChange={updateUsername}
          />

          <div className="action">
            <button onClick={handleChangeUsername}>
              <h3>Change Username</h3>
            </button>
          </div>
        </span>

        <span className="change-name">
          <input
            className="input-name"
            type="text"
            name="firstname"
            placeholder="First Name"
            value={firstName}
            onChange={updateFirstName}
          />

          <input
            className="input-name"
            type="text"
            name="lastname"
            placeholder="Last Name"
            value={lastName}
            onChange={updateLastName}
          />

          <div className="action">
            <button onClick={handleChangeName}>
              <h3>Change Name</h3>
            </button>
          </div>
        </span>

        <span className="change-nickname">
          <input
            className="input-name"
            type="text"
            name="nickname"
            placeholder="Nickname"
            value={nickname}
            onChange={updateNickname}
          />

          <div className="action">
            <button onClick={handleChangeNickname}>
              <h3>Change Nickname</h3>
            </button>
          </div>
        </span>

        <span className="change-nicename">
          <input
            className="input-name"
            type="text"
            name="nicename"
            placeholder="Nicename"
            value={nicename}
            onChange={updateNicename}
          />

          <div className="action">
            <button onClick={handleChangeNicename}>
              <h3>Change Nicename</h3>
            </button>
          </div>
        </span>

        {/* Create Change Title (roles) */}

        <span className="change-phone">
          <input
            className="input-phone"
            type="text"
            name="phone"
            placeholder="Phone Number"
            value={phoneChange}
            onChange={updatePhone}
          />

          <div className="action">
            <button onClick={handleChangePhone}>
              <h3>Change Phone</h3>
            </button>
          </div>
        </span>

        <span className="logout">
          <button onClick={handleLogout}>
            <h3>LOG OUT</h3>
          </button>

          {logoutAllUrl != null && (
            <button onClick={handleLogoutAll}>
              <h3>LOG OUT ALL</h3>
            </button>
          )}
        </span>

        <span className="lock-account">
          <button onClick={handleLockAccount}>
            <h3>LOCK ACCOUNT</h3>
          </button>
        </span>

        <span className={showStatusBar}>
          {message != '' && (
            <StatusBarComponent messageType={messageType} message={message} />
          )}
        </span>
      </main>
    </>
  );
}

export default SettingsComponent;
