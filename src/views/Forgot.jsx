import { useState } from 'react';

import NavigationComponent from './Navigation';

function ForgotComponent() {
  const [Email, setEmail] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    forgot(Email);
  };

  const handleChange = (e) => {
    if (e.target.name === 'email') {
      setEmail(e.target.value);
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
            </tbody>
            <tfoot>
              <td>
                <button type="submit" onClick={handleSubmit}>
                  <h3>RESET</h3>
                </button>
              </td>
            </tfoot>
          </table>
        </form>
      </div>
    </>
  );
}

export default ForgotComponent;
