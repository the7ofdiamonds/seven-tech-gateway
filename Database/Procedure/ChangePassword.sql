CREATE DEFINER=`root`@`%` PROCEDURE `changePassword`(
    IN p_user_email VARCHAR(255), 
    IN p_user_pass_new VARCHAR(255)
)
BEGIN
    DECLARE user_id INT;

    SELECT u.ID INTO user_id
    FROM wordpress.wp_users u
    WHERE u.user_email COLLATE utf8mb4_unicode_520_ci = p_user_email;

    IF user_id IS NOT NULL THEN
        UPDATE wordpress.wp_users
        SET user_pass = p_user_pass_new
        WHERE ID = user_id;
    END IF;
    
	SELECT CASE WHEN ROW_COUNT() > 0 THEN 'TRUE' ELSE 'FALSE' END AS resultSet;
END