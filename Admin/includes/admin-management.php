<div class="management">
    <h1>Management</h1>

    <form method="post" class="create-account" id="create_account">
        <input className="input-username" type="text" name="username" placeholder="Username" required />
        <input className="input-email" type="email" name="email" placeholder="Email" required />

        <input className="input-password" type="password" name="password" placeholder="Password" required />
        <input className="input-password" type="password" name="confirm-password" placeholder="Confirm Password" required />

        <select name="roles[]" id="role_select_add" multiple>
            <?php
            $active_roles = wp_roles()->get_names();

            foreach ($active_roles as $role => $display_name) : ?>
                <option value="<?php echo esc_attr($role); ?>" data-display-name="<?php echo esc_attr($display_name); ?>">
                    <?php echo esc_html($display_name); ?> (<?php echo esc_html($role); ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <input type="hidden" name="display_name_add" id="display_name_add">

        <input className="input-name" type="text" name="nicename" placeholder="Nice Name (eg. /nicename)" required />
        <input className="input-name" type="text" name="nickname" placeholder="Nickname" required />

        <input className="input-name" type="text" name="firstname" placeholder="First Name" required />
        <input className="input-name" type="text" name="lastname" placeholder="Last Name" required />

        <input className="input-phone" type="tel" name="phone" placeholder="Phone" required />

        <button type="submit">
            <h3>CREATE</h3>
        </button>
    </form>
</div>