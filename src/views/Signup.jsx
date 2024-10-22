import { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import NavigationLoginComponent from './components/NavigationLoginComponent';
import StatusBarComponent from './components/StatusBarComponent';

import { signup } from '../controllers/signupSlice';
import {
  updateAccessToken,
  updateRefreshToken,
} from '../controllers/loginSlice';

function SignUpComponent() {
  let page = 'signup';

  const [username, setUsername] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [nicename, setNicename] = useState('');
  const [nickname, setNickname] = useState('');
  const [firstname, setFirstname] = useState('');
  const [lastname, setLastname] = useState('');
  const [phone, setPhone] = useState('');

  const [showStatusbar, setShowStatusBar] = useState('');
  const [message, setMessage] = useState(
    'Enter the username, email, and password of your choice to sign up.'
  );
  const [messageType, setMessageType] = useState('');

  const dispatch = useDispatch();

  const {
    signupStatusCode,
    signupSuccessMessage,
    signupErrorMessage,
    accessToken,
    refreshToken,
  } = useSelector((state) => state.signup);

  useEffect(() => {
    if (
      password !== '' &&
      confirmPassword !== '' &&
      password === confirmPassword
    ) {
      const msg = 'You have successfully entered your password twice.';
      setMessage(msg);
      setMessageType('success');
    } else if (password !== '' && password !== confirmPassword) {
      const msg = 'You have not entered your password twice.';
      setMessage(msg);
      setMessageType('error');
    }
  }, [password, confirmPassword]);

  useEffect(() => {
    if (
      signupStatusCode == 200 &&
      signupSuccessMessage &&
      accessToken &&
      refreshToken
    ) {
      setMessageType('success');
      setMessage(signupSuccessMessage);
    }
  }, [signupStatusCode, signupSuccessMessage, accessToken, refreshToken]);

  useEffect(() => {
    if (signupErrorMessage) {
      setMessageType('error');
      setMessage(signupErrorMessage);
    }
  }, [signupErrorMessage]);

  useEffect(() => {
    if (signupSuccessMessage != '') {
      setShowStatusBar('modal-overlay');
    }
  }, [signupSuccessMessage]);

  useEffect(() => {
    if (accessToken && refreshToken) {
      dispatch(updateAccessToken(accessToken));
      dispatch(updateRefreshToken(refreshToken));
    }
  }, [dispatch, accessToken, refreshToken]);

  useEffect(() => {
    if (accessToken && refreshToken && signupStatusCode == 200) {
      const urlParams = new URLSearchParams(window.location.search);
      const redirectTo = urlParams.get('redirectTo');

      setTimeout(() => {
        if (redirectTo == null) {
          window.location.href = '/dashboard';
        } else {
          window.location.href = redirectTo;
        }
      }, 7000);
    }
  }, [dispatch, accessToken, refreshToken, signupStatusCode]);

  const credentials = {
    username: username,
    email: email,
    password: password,
    confirmPassword: confirmPassword,
    nicename: nicename,
    nickname: nickname,
    firstname: firstname,
    lastname: lastname,
    phone: phone,
    location: 'here',
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    dispatch(signup(credentials));
  };

  const handleChange = (e) => {
    if (e.target.name === 'username') {
      setUsername(e.target.value);
    } else if (e.target.name === 'email') {
      setEmail(e.target.value);
    } else if (e.target.name === 'password') {
      setPassword(e.target.value);
    } else if (e.target.name === 'confirm-password') {
      setConfirmPassword(e.target.value);
    } else if (e.target.name === 'nicename') {
      setNicename(e.target.value);
    } else if (e.target.name === 'nickname') {
      setNickname(e.target.value);
    } else if (e.target.name === 'firstname') {
      setFirstname(e.target.value);
    } else if (e.target.name === 'lastname') {
      setLastname(e.target.value);
    } else if (e.target.name === 'phone') {
      setPhone(e.target.value);
    }
  };

  return (
    <>
      <main className="signup">
        <NavigationLoginComponent page={page} />

        <div className="signup card">
          <form>
            <table>
              <tbody>
                <tr>
                  <td>
                    <input
                      className="input-username"
                      type="text"
                      name="username"
                      placeholder="Username"
                      onChange={handleChange}
                      required
                    />
                    <input
                      className="input-email"
                      type="email"
                      name="email"
                      placeholder="Email"
                      onChange={handleChange}
                      required
                    />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input
                      className="input-password"
                      type="password"
                      name="password"
                      placeholder="Password"
                      onChange={handleChange}
                      required
                    />
                    <input
                      className="input-password"
                      type="password"
                      name="confirm-password"
                      placeholder="Confirm Password"
                      onChange={handleChange}
                      required
                    />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input
                      className="input-name"
                      type="text"
                      name="nicename"
                      placeholder="Nice Name (eg. /nicename)"
                      onChange={handleChange}
                      required
                    />
                    <input
                      className="input-name"
                      type="text"
                      name="nickname"
                      placeholder="Nickname"
                      onChange={handleChange}
                      required
                    />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input
                      className="input-name"
                      type="text"
                      name="firstname"
                      placeholder="First Name"
                      onChange={handleChange}
                      required
                    />
                    <input
                      className="input-name"
                      type="text"
                      name="lastname"
                      placeholder="Last Name"
                      onChange={handleChange}
                      required
                    />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input
                      className="input-phone"
                      type="tel"
                      name="phone"
                      placeholder="Phone"
                      onChange={handleChange}
                      required
                    />
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <td>
                  <button type="submit" onClick={handleSubmit} id="signup_btn">
                    <h3>SIGN UP</h3>
                  </button>
                </td>
              </tfoot>
            </table>
          </form>
        </div>

        <span className={showStatusbar}>
          {message !== '' && (
            <StatusBarComponent messageType={messageType} message={message} />
          )}
        </span>
      </main>
    </>
  );
}

export default SignUpComponent;
