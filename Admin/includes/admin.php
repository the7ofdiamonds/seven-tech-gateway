<script src=<?php echo SEVEN_TECH_URL . "Admin/includes/js/StatusBar.js"; ?> defer></script>
<script src=<?php echo SEVEN_TECH_URL . "Admin/includes/js/Dashboard.js"; ?> defer></script>

<style>
    .dashboard {
        padding-top: 1rem;
    }

    .options {
        display: flex;
        gap: 1.5rem;
        align-items: center;
        justify-content: center;
    }

    .options button h3 {
        margin: 0;
    }

    .dashboard .google-creds {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
</style>

<div class="dashboard">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <?php include_once SEVEN_TECH . 'Admin/includes/admin-status-bar.php'; ?>

    <h2>Google Service Account</h2>

    <div class="google-creds" id="google_creds">
        <h4 id="google_creds_message"></h4>

        <form class="google-creds-upload" id="google_creds_upload" enctype="multipart/form-data">
            <input type="file" name="file" id="file" required>
            <button type="submit" id="submit">Upload</button>
        </form>
    </div>
</div>