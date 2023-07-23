import { useState } from 'react';

import NavigationComponent from './Navigation';

import { login } from '../utils/login';

function LoginComponent() {
  const [Email, setEmail] = useState('');
  const [Password, setPassword] = useState('');

  const handleChange = (e) => {
    if (e.target.name === 'email') {
      setEmail(e.target.value);
    } else if (e.target.name === 'password') {
      setPassword(e.target.value);
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    login(Email, Password);
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
            </tbody>
            <tfoot>
              <td>
                <button type="submit" onClick={handleSubmit}>
                  <h3>LOGIN</h3>
                </button>
              </td>
            </tfoot>
          </table>
        </form>
      </div>
    </>
  );
}

export default LoginComponent;
