CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`%` 
    SQL SECURITY DEFINER
VIEW `user_details_view` AS
    SELECT 
        `u`.`ID` AS `id`,
        `u`.`user_email` AS `email`,
        `u`.`display_name` AS `username`,
        `u`.`user_pass` AS `password`,
        `u`.`user_nicename` AS `nicename`,
        `u`.`user_registered` AS `joined`,
        `u`.`user_activation_key` AS `user_activation_key`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'phone_number') THEN `m`.`meta_value`
        END)) AS `phone`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'nickname') THEN `m`.`meta_value`
        END)) AS `nickname`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'first_name') THEN `m`.`meta_value`
        END)) AS `first_name`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'last_name') THEN `m`.`meta_value`
        END)) AS `last_name`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'wp_capabilities') THEN `m`.`meta_value`
        END)) AS `roles`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'description') THEN `m`.`meta_value`
        END)) AS `bio`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'provider_given_id') THEN `m`.`meta_value`
        END)) AS `provider_given_id`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'is_authenticated') THEN `m`.`meta_value`
        END)) AS `is_authenticated`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'is_account_non_expired') THEN `m`.`meta_value`
        END)) AS `is_account_non_expired`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'is_account_non_locked') THEN `m`.`meta_value`
        END)) AS `is_account_non_locked`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'is_credentials_non_expired') THEN `m`.`meta_value`
        END)) AS `is_credentials_non_expired`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'is_enabled') THEN `m`.`meta_value`
        END)) AS `is_enabled`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'confirmation_code') THEN `m`.`meta_value`
        END)) AS `confirmation_code`,
        MAX((CASE
            WHEN (`m`.`meta_key` = 'additional_emails') THEN `m`.`meta_value`
        END)) AS `additional_emails`
    FROM
        (`wp_users` `u`
        LEFT JOIN `wp_usermeta` `m` ON ((`u`.`ID` = `m`.`user_id`)))
    GROUP BY `u`.`ID` , `u`.`user_login` , `u`.`user_email`