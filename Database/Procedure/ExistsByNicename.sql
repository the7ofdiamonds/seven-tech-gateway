CREATE DEFINER=`root`@`%` PROCEDURE `existsByNicename`(
    IN p_user_nicename VARCHAR(255)
)
BEGIN
	 SELECT
        CASE
            WHEN COUNT(*) > 0 THEN 1
            ELSE 0
        END AS resultSet
    FROM
        wordpress.wp_users AS u
    WHERE
        u.user_nicename COLLATE utf8mb4_unicode_ci = p_user_nicename;
END