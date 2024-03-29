import { useState } from 'react';
import { useDispatch } from 'react-redux';

import { sendForgotPasswordEmail } from '../../controllers/passwordSlice';

function ForgotComponent() {
  const dispatch = useDispatch();

  const [email, setEmail] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    dispatch(sendForgotPasswordEmail(email));
  };

  const handleChange = (e) => {
    if (e.target.name === 'email') {
      setEmail(e.target.value);
    }
  };

  return (
    <>
      <div className="card">
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