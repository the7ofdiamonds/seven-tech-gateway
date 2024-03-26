import { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import NavigationComponent from './components/NavigationLogin';
import LoginComponent from './components/LoginComponent';

import {
  login,
  updateDisplayName,
  updateEmail,
  updateProfileImage,
  updateAccessToken,
  updateRefreshToken,
} from '../controllers/loginSlice';

import { token } from '../controllers/tokenSlice';

import {
  getAuth,
  GoogleAuthProvider,
  OAuthProvider,
  signInWithPopup,
} from 'firebase/auth';
import { getLocation } from '../utils/location';

const firebaseAuth = getAuth();
const google = new GoogleAuthProvider();
const microsoft = new OAuthProvider('microsoft.com');
const apple = new OAuthProvider('apple');

function Login() {
  let page = 'login';

  const dispatch = useDispatch();

  const {
    loginSuccessMessage,
    loginErrorMessage,
    loginError,
    accessToken,
    refreshToken,
    displayName,
    profileImage,
  } = useSelector((state) => state.login);
  const { tokenSuccessMessage, tokenErrorMessage } = useSelector(
    (state) => state.token
  );

  const [identity, setIdentity] = useState('');
  const [password, setPassword] = useState('');
  const [location, setLocation] = useState('');
  const [messageType, setMessageType] = useState('');
  const [message, setMessage] = useState(
    'Enter your email and password to log in.'
  );

  useEffect(() => {
    getLocation().then((location) => {
      setLocation({
        longitude: location.longitude,
        latitude: location.latitude,
      });
    });
  }, []);

  useEffect(() => {
    if (loginSuccessMessage || tokenSuccessMessage) {
      const msg = loginSuccessMessage
        ? loginSuccessMessage
        : tokenSuccessMessage;

      setMessage(msg);
      setMessageType('success');
    }
  }, [loginSuccessMessage, tokenSuccessMessage]);

  useEffect(() => {
    if (loginErrorMessage || tokenErrorMessage) {
      const msg = loginErrorMessage ? loginErrorMessage : tokenErrorMessage;

      setMessage(msg);
      setMessageType('error');
    }
  }, [loginErrorMessage, tokenErrorMessage]);

  useEffect(() => {
    if (accessToken && refreshToken) {
      const urlParams = new URLSearchParams(window.location.search);
      const redirectTo = urlParams.get('redirectTo');

      setTimeout(() => {
        if (redirectTo == null) {
          window.location.href = '/dashboard';
        } else {
          window.location.href = redirectTo;
        }
      }, 5000);
    }
  }, [accessToken, refreshToken]);

  const handleIdentityChange = async (e) => {
    setIdentity(e.target.value);
  };

  const handlePasswordChange = async (e) => {
    setPassword(e.target.value);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    dispatch(
      login({
        identity: identity,
        password: password,
        location: location,
      })
    );
  };

  const handleGoogleSignIn = async () => {
    await signInWithPopup(firebaseAuth, google).then((response) => {
      dispatch(updateDisplayName(response.user.displayName));
      dispatch(updateEmail(response.user.email));
      dispatch(updateProfileImage(response.user.photoURL));

      var accessToken = response._tokenResponse.idToken;
      dispatch(updateAccessToken(accessToken));
      var refreshToken = response._tokenResponse.refreshToken;
      dispatch(updateRefreshToken(refreshToken));
      dispatch(token(accessToken, refreshToken, location));
    });
  };

  const handleMicrosoftSignIn = async () => {
    await signInWithPopup(firebaseAuth, microsoft).then((response) => {
      dispatch(updateDisplayName(response.user.displayName));
      dispatch(updateEmail(response.user.email));
      dispatch(updateProfileImage(response.user.photoURL));

      var accessToken = response._tokenResponse.idToken;
      dispatch(updateAccessToken(accessToken));
      var refreshToken = response._tokenResponse.refreshToken;
      dispatch(updateRefreshToken(refreshToken));
      dispatch(token(accessToken, refreshToken, location));
    });
  };

  const handleAppleSignIn = async () => {
    await signInWithPopup(firebaseAuth, apple).then((response) => {
      dispatch(updateDisplayName(response.user.displayName));
      dispatch(updateEmail(response.user.email));
      dispatch(updateProfileImage(response.user.photoURL));

      var accessToken = response._tokenResponse.idToken;
      dispatch(updateAccessToken(accessToken));
      var refreshToken = response._tokenResponse.refreshToken;
      dispatch(updateRefreshToken(refreshToken));
      dispatch(token(accessToken, refreshToken, location));
    });
  };

  return (
    <>
      <main className="login">
        <NavigationComponent page={page} />
        
        <LoginComponent />

        {message !== '' && (
          <div className={`status-bar card ${messageType}`}>
            <span>
              <div dangerouslySetInnerHTML={{ __html: message }} />
            </span>
          </div>
        )}
      </main>
    </>
  );
}

export default LoginComponent;
