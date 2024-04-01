import { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';

import NavigationLoginComponent from './components/NavigationLoginComponent';

import { signup } from '../controllers/signupSlice';

function SignUpComponent() {
  let page = 'signup';

  const [UserName, setUserName] = useState('');
  const [Email, setEmail] = useState('');
  const [Password, setPassword] = useState('');
  const [ConfirmPassword, setConfirmPassword] = useState('');
  const [firstname, setFirstname] = useState('');
  const [lastname, setLastname] = useState('');
  const [phone, setPhone] = useState('');
  const [message, setMessage] = useState(
    'Enter the username, email, and password of your choice to sign up.'
  );
  const [messageType, setMessageType] = useState('');

  const dispatch = useDispatch();

  const { signupStatusCode, signupSuccessMessage, signupErrorMessage } =
    useSelector((state) => state.signup);

    useEffect(() => {
    if (
      Password !== '' &&
      ConfirmPassword !== '' &&
      Password === ConfirmPassword
    ) {
      const msg = 'You have successfully entered your password twice.';
      setMessage(msg);
      setMessageType('success');
    } else if (Password !== '' && Password !== ConfirmPassword) {
      const msg = 'You have not entered your password twice.';
      setMessage(msg);
      setMessageType('error');
    }
  }, [Password, ConfirmPassword]);

  useEffect(() => {
    if (signupStatusCode == 201) {
      setTimeout(() => {
        window.location.href = '/login';
      }, 5000);
    }
  }, [signupStatusCode]);

  useEffect(() => {
    if (signupSuccessMessage) {
      setMessageType('success');
      setMessage(signupSuccessMessage);
    }
  }, [signupSuccessMessage]);

  useEffect(() => {
    if (signupErrorMessage) {
      setMessageType('error');
      setMessage(signupErrorMessage);
    }
  }, [signupErrorMessage]);

  const credentials = {
    username: UserName,
    email: Email,
    password: Password,
    confirmPassword: ConfirmPassword,
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
    if (e.target.name === 'user-name') {
      setUserName(e.target.value);
    } else if (e.target.name === 'email') {
      setEmail(e.target.value);
    } else if (e.target.name === 'password') {
      setPassword(e.target.value);
    } else if (e.target.name === 'confirm-password') {
      setConfirmPassword(e.target.value);
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

        <div className="login card">
          <form>
            <table>
              <thead></thead>
              <tbody>
                <tr>
                  <td>
                    <input
                      type="text"
                      name="user-name"
                      placeholder="User Name"
                      onChange={handleChange}
                      required
                    />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input
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
                      type="password"
                      name="password"
                      placeholder="Password"
                      onChange={handleChange}
                      required
                    />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input
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
                      type="text"
                      name="firstname"
                      placeholder="First Name"
                      onChange={handleChange}
                      required
                    />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input
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
                      type="text"
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
                  <button type="submit" onClick={handleSubmit}>
                    <h3>SIGN UP</h3>
                  </button>
                </td>
              </tfoot>
            </table>
          </form>
        </div>

        {message !== '' && (
          <div className={`status-bar card ${messageType}`}>
            <span>{message}</span>
          </div>
        )}
      </main>
    </>
  );
}

export default SignUpComponent;
