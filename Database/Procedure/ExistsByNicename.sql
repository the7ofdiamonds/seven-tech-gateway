CREATE DEFINER=`root`@`%` PROCEDURE `existsByNicename`(
    IN p_user_nicename VARCHAR(255)
)
BEGIN
	SELECT EXISTS(
        SELECT 1
        FROM wordpress.wp_users AS u
        WHERE u.user_nicename = p_user_nicename COLLATE utf8mb4_unicode_ci
    ) AS resultSet;
END