import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import { logout, logoutAllUrl, logoutAll } from '../controllers/logoutSlice';
import { removeAccount } from '../controllers/accountSlice';

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

  {
    /* Create Change Title (roles) */
  }

  const handleChangeUsername = () => {
    dispatch(changeUsername());
  };

  const handleChangePassword = () => {
    dispatch(changePassword());
  };

  {
    /* Forgot password button */
  }

  const handleForgotPassword = () => {
    dispatch(forgotPassword());
  };

  const handlePhone = () => {
    dispatch(changePhone());
  };

  const handleRemoveEmail = () => {
    dispatch(removeEmail());
  };

  const handleRemoveAccount = () => {
    dispatch(removeAccount());
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

  return (
    <section className="dashboard">
      <h2 className="title">Dashboard</h2>
      <div>
        <div>
          <img src={`${profileImg}`} alt="" />
        </div>
        <span>{usersDisplayName}</span>
      </div>

      <div>
        {/* Change Name */}

        {/* Create Change Title (roles) */}

        {/* Chanage Username */}

        {/* Change Password */}

        {/* Forgot password button */}

        {/* Change Phone */}

        {/* Remove Email */}

        {/* Delete (remove) Account */}
      </div>

      <div>
        <div>
          <button onClick={handleLogout}>
            <h3>LOG OUT</h3>
          </button>

          {logoutAllUrl != null && (
            <button onClick={handleLogoutAll}>
              <h3>LOG OUT ALL</h3>
            </button>
          )}
        </div>

        {message !== '' && (
          <div className={`status-bar card ${messageType}`}>
            <span>{message}</span>
          </div>
        )}
      </div>
    </section>
  );
}

export default Dashboard;
