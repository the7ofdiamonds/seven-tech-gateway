import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import LoginComponent from '../views/Login';
import SettingsComponent from './components/SettingsComponent';

function Dashboard() {
  const dispatch = useDispatch();
  const { profileImage, displayName } = useSelector((state) => state.login);

  const profileImg = profileImage
    ? profileImage
    : localStorage.getItem('profile_image');
  const usersDisplayName = displayName
    ? displayName
    : localStorage.getItem('display_name');

  const { changeStatusCode } = useSelector((state) => state.change);
  const { emailStatusCode } = useSelector((state) => state.email);
  const { passwordStatusCode } = useSelector((state) => state.password);
  const { loginStatusCode } = useSelector((state) => state.login);
  const { accountStatusCode } = useSelector((state) => state.account);

  const [showSettings, setShowSettings] = useState('');
  const [showLogin, setShowLogin] = useState(false);

  useEffect(() => {
    if (loginStatusCode == 200) {
      setShowLogin(false);
    }
  }, [loginStatusCode]);

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

  const handleShowSettings = () => {
    if (showSettings == false) {
      setShowSettings(true);
    }

    if (showSettings == true) {
      setShowSettings(false);
    }
  };

  return (
    <>
      <h2 className="title">Dashboard</h2>

      <div className="header">
        <div className="profile-image">
          <img src={`${profileImg}`} alt="" />
        </div>

        <h2 className="display-name">{usersDisplayName}</h2>

        <div className="options">
          <button className="settings-button" onClick={handleShowSettings}>
            <i class="fa-solid fa-gears"></i>
          </button>
        </div>
      </div>

      {showSettings && <SettingsComponent />}

      {showLogin && (
        <div className="modal-overlay">
          <main className="login">
            <LoginComponent />
          </main>
        </div>
      )}
    </>
  );
}

export default Dashboard;
