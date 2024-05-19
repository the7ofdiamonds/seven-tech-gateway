function displayMessage(type, message) {
    const messageDiv = jQuery('#status_bar');
    messageDiv.css('display', 'flex');
    messageDiv.removeClass('notice-success notice-error');
    messageDiv.addClass(type === 'success' ? 'notice-success' : 'notice-error');
    messageDiv.find('p').text(message);
    messageDiv.show();
}