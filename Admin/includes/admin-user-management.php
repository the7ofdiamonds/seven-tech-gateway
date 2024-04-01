<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emailGU'])) {
    $email = $_POST['emailGU'];
    $this->getUser($email);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emailFP'])) {
    $email = $_POST['emailFP'];
    $this->forgotPassword($email);
}
?>
<h1>User Management</h1>

<form method="post">
    <table>
        <tbody>
            <tr>
                <td>Find User</td>
                <td><input type="email" name="emailGU" required></td>
                <td><button type="submit">Find</button></td>
            </tr>
        </tbody>
    </table>
</form>

<form method="post">
    <table>
        <tbody>
            <tr>
                <td>Send Password Recovery Email</td>
                <td><input type="email" name="emailFP" required></td>
                <td><button type="submit">Send</button></td>
            </tr>
        </tbody>
    </table>
</form>