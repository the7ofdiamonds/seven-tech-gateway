export function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

export function isValidUsername(username) {
    const usernameRegex = /^[a-zA-Z0-9]+$/;
    return usernameRegex.test(username);
}

export function isValidPassword(password) {
    const passwordRegex = /^[0-9a-zA-Z$@#%^&*_-]+$/;
    return passwordRegex.test(password);
}

export function isValidConfirmationCode(confirmationCode) {
    const confirmationCodeRegex = /^[a-zA-Z0-9\-]+$/;
    return confirmationCodeRegex.test(confirmationCode);
}

export function isValidName(name) {
    const nameRegex = /^[a-zA-Z]+$/;
    return nameRegex.test(name);
}

export function isValidPhone(phone) {
    const phoneRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return phoneRegex.test(phone);
}