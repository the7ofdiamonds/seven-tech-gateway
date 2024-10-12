CREATE DEFINER=`root`@`%` PROCEDURE `existsByEmail`(
    IN p_user_email VARCHAR(255)
)
BEGIN
    SELECT
        CASE
            WHEN COUNT(*) > 0 THEN 'TRUE'
            ELSE 'FALSE'
        END AS resultSet
    FROM
        wordpress.wp_users AS u
    WHERE
        u.user_email COLLATE utf8mb4_unicode_ci = p_user_email;
END