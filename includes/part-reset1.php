<?php
    //Reset
    global $wpdb;

    if ($_POST) {
        $resetUserName = $wpdb->escape($_POST['resetUserName']);

        $resetError = array();

        if (empty($resetUserName)) {
            $message = 'Please enter your Username';
            $resetError[] = $message;
        } elseif (strpos($resetUserName, ' ') !== FALSE) {
            $message = "There is a space in the Username entered";
            $resetError[] = $message;
        } elseif (!username_exists($resetUserName)) {
            $message = 'Username does not exists';
            $resetError[] = $message;
        } elseif (username_exists($resetUserName) && count($resetError) == 0) {

            retrieve_password($resetUserName);
            echo "Reset password email sent";
            exit();                
        } 
    }
?>

<form method="post" class='reset-card card' id='reset'>

    <?php
        if (empty($_POST)) {
            echo "<div class='username' id='userName'>";
        } elseif (empty($resetUserName) || strpos($resetUserName, ' ') !== FALSE || !username_exists($resetUserName)) {
            echo "<p class='error'> $message </p>
            <div class='username error' id='userName'>";
        } elseif (username_exists($resetUserName)) {
            echo "<p class='success'> $message </p>
            <div class='username success' id='userName'>";
        } 
    ?>
        <label for="username-or-password">Username or Email</label>
        <input class="input" type="text" name='resetUserName' id='resetUserName' placeholder='Username or Email' value='<?php echo $resetUserName ?>'>
    </div>

    <button type="submit">
        <h3>RESET</h3>
    </button>
</form>