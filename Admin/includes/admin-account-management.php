<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emailLA'])) {
    $email = $_POST['emailLA'];
    $this->lockAccount($email);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emailUA'])) {
    $email = $_POST['emailUA'];
    $this->unlockAccount($email);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emailRA'])) {
    $email = $_POST['emailRA'];
    $this->removeAccount($email);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emailDA'])) {
    $email = $_POST['emailDA'];
    $this->deleteAccount($email);
}
?>
<h1>Account Management</h1>

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