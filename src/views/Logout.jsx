import { logout } from '../utils/logout';

function LogOutComponent() {

  return (
    <>
      <div className="login card">
        <form>
          <table>
            <thead></thead>
            <tbody></tbody>
            <tfoot>
              <td>
                <button type="submit">
                  <h3>LOGOUT</h3>
                </button>
              </td>
            </tfoot>
          </table>
        </form>
      </div>
    </>
  );
}

export default LogOutComponent;
