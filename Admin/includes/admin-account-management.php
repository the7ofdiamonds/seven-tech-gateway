<h1>Account Management</h1>

<form method="post" id="find_account">
    <table>
        <tbody>
            <tr>
                <td>Find Account</td>
                <td>
                    <input type="email" name="email" placeholder="Email" required>
                </td>

                <td><button type="submit">Find</button></td>
            </tr>
        </tbody>
    </table>
</form>

<div class="account" id="account">
    <input type="text" name="account_id" id="account_id" disabled>
    <h3 id="first_name"></h3>
    <h3 id="last_name"></h3>
    <h3 id="nicename"></h3>
    <div class="roles-row" id="user_roles"></div>
    <input type="email" name="email" id="email" disabled>
</div>

<form method="post">
    <table>
        <tbody>
            <tr>
                <td>Lock Account</td>
                <td><input type="email" name="emailLA" required></td>
                <td><button type="submit">Lock</button></td>
            </tr>
        </tbody>
    </table>
</form>

<form method="post">
    <table>
        <tbody>
            <tr>
                <td>Unlock Account</td>
                <td><input type="email" name="emailUA" required></td>
                <td><button type="submit">Unlock</button></td>
            </tr>
        </tbody>
    </table>
</form>

<form method="post">
    <table>
        <tbody>
            <tr>
                <td>Remove Account</td>
                <td><input type="email" name="emailRA" required></td>
                <td><button type="submit">Remove</button></td>
            </tr>
        </tbody>
    </table>
</form>

<form method="post">
    <table>
        <tbody>
            <tr>
                <td>Delete Account</td>
                <td><input type="email" name="emailDA" required></td>
                <td><button type="submit">Delete</button></td>
            </tr>
        </tbody>
    </table>
</form>