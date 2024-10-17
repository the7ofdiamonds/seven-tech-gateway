import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import { getUser } from '../../controllers/userSlice';
import {
  changeUsername,
  changeName,
  changeNickname,
  changeNicename,
  changePhone
} from '../../controllers/changeSlice';

import StatusBarComponent from './StatusBarComponent';

function ChangeComponent() {
  const dispatch = useDispatch();

  const {
    userLoading,
    userError,
    userSuccessMessage,
    userErrorMessage,
    userStatusCode,
    username,
    firstname,
    lastname,
    nickname,
    nicename,
    phone,
  } = useSelector((state) => state.user);

  useEffect(() => {
    dispatch(getUser());
  }, [dispatch]);

  useEffect(() => {
    if (username) {
      setUsernameChange(username);
    }

    if (firstname) {
      setFirstNameChange(firstname);
    }

    if (lastname) {
      setLastNameChange(lastname);
    }

    if (nickname) {
      setNicknameChange(nickname);
    }

    if (nicename) {
      setNicenameChange(nicename);
    }

    if (phone) {
      setPhoneChange(phone);
    }
  }, [username, firstName, lastname, nickname, nicename, phone]);

  useEffect(() => {
    if (userLoading) {
      setMessage('');
    }
  }, [dispatch, userLoading]);

  useEffect(() => {
    if (userSuccessMessage) {
      setMessageType('success');
      setMessage(userSuccessMessage);
    }
  }, [dispatch, userSuccessMessage]);

  useEffect(() => {
    if (userErrorMessage && userStatusCode != 403) {
      setMessageType('error');
      setMessage(userErrorMessage);
    }
  }, [dispatch, userErrorMessage]);

  useEffect(() => {
    if (userStatusCode != 403 &&
      message != ''
    ) {
      setShowStatusBar('modal-overlay');
      setTimeout(() => {
        setShowStatusBar('');
      }, 3000);
    }
  }, [
    dispatch,
    userStatusCode,
    message
  ]);

  const [usernameChange, setUsernameChange] = useState(username);
  const [firstName, setFirstNameChange] = useState(firstname);
  const [lastName, setLastNameChange] = useState(lastname);
  const [nicknameChange, setNicknameChange] = useState(nickname);
  const [nicenameChange, setNicenameChange] = useState(nicename);
  const [phoneChange, setPhoneChange] = useState(phone);

  const [showStatusBar, setShowStatusBar] = useState('');
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState('');

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

  return (
    <>
      <main className="change">

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
            value={nicknameChange}
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
            value={nicenameChange}
            onChange={updateNicename}
          />

          <div className="action">
            <button onClick={handleChangeNicename}>
              <h3>Change Nicename</h3>
            </button>
          </div>
        </span>

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

        <span className={showStatusBar}>
          {message != '' && (
            <StatusBarComponent messageType={messageType} message={message} />
          )}
        </span>
      </main>
    </>
  );
}

export default ChangeComponent;
