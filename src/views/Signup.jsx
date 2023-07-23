import { useState } from 'react';

import NavigationComponent from './Navigation';

function SignUpComponent() {

  const [Email, setEmail] = useState('');
  const [Password, setPassword] = useState('');
  const [ConfirmPassword, setConfirmPassword] = useState('');

  if(Password !== '' && ConfirmPassword !== '' && Password === ConfirmPassword){
    console.log('twins!!!')
  }

  const handleSubmit = async (e) => {
    e.preventDefault();

    signup(Email, Password);
  };

  const handleChange = (e) => {
    if (e.target.name === 'email') {
      setEmail(e.target.value);
    } else if (e.target.name === 'password') {
      setPassword(e.target.value);
    } else if (e.target.name === 'confirm-password') {
      setConfirmPassword(e.target.value);
    }
  };

  return (
    <>
      <NavigationComponent />
      <div className="login card">
        <form>
          <table>
            <thead></thead>
            <tbody>
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
            </tbody>
            <tfoot>
              <td>
                <button type="submit" onClick={handleSubmit}>
                  <h3>SIGNUP</h3>
                </button>
              </td>
            </tfoot>
          </table>
        </form>
      </div>
    </>
  );
}

export default SignUpComponent;