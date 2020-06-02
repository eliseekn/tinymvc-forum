function togglePassword(inputId) {
    const inputType = document.querySelector(inputId)

    if (inputType.type === 'password') {
        inputType.type = 'text';
    } else {
        inputType.type = 'password';
    }
}