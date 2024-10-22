CREATE DEFINER=`root`@`%` PROCEDURE `existsByPhone`(
    IN p_phone_number VARCHAR(255)
)
BEGIN
	 SELECT
        CASE
            WHEN COUNT(*) > 0 THEN 1
            ELSE 0
        END AS resultSet
	FROM wp_usermeta AS m
    WHERE m.meta_key = 'phone_number' AND m.meta_value COLLATE utf8mb4_unicode_ci = p_phone_number;
END