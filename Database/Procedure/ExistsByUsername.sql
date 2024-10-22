CREATE DEFINER=`root`@`%` PROCEDURE `existsByUsername`(
    IN p_display_name VARCHAR(255)
)
BEGIN
	 SELECT
        CASE
            WHEN COUNT(*) > 0 THEN 1
            ELSE 0
        END AS resultSet
        FROM wordpress.wp_users AS u
        WHERE u.display_name COLLATE utf8mb4_unicode_ci = p_display_name;
END