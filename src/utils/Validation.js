
export function isValidEmail(email) {

    if (email == '' || email == undefined) {
        throw new Error("Email is required to be validated.");
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    return emailRegex.test(email);
}

export function isValidUsername(username) {

    if (username == '' || username == undefined) {
        throw new Error("A username is required to be validated.");
    }

    const usernameRegex = /^[a-zA-Z0-9]{3,20}$/;

    return usernameRegex.test(username);
}

export function isValidPassword(password) {

    if (password == '' || password == undefined) {
        throw new Error("A password is required to be validated.");
    }

    const passwordRegex = /^[0-9a-zA-Z$@#%^&*_-]{8,20}$/;

    return passwordRegex.test(password);
}

export function isValidConfirmationCode(confirmationCode) {

    if (confirmationCode == '') {
        throw new Error("A confirmation code is required to be validated.");
    }

    const confirmationCodeRegex = /^[a-zA-Z0-9-]+$/;

    return confirmationCodeRegex.test(confirmationCode);
}

export function isValidName(name) {

    if (name == '') {
        throw new Error("A name is required to be validated.");
    }

    const nameRegex = /^[a-zA-Z]+$/;

    return nameRegex.test(name);
}

export function isValidPhone(phone) {

    if (phone == '' || phone == undefined) {
        throw new Error("A phone number is required to be validated.");
    }

    const phoneRegex = /^[0-9]{11,}$/;

    return phoneRegex.test(phone);
}
