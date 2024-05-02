const firstName = document.getElementById('first-name');
const lastName = document.getElementById('last-name');
const email = document.getElementById('email');
const Age = document.getElementById('age');
const phone = document.getElementById('phone');
const address = document.getElementById('address');
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirm-password');


const firstNameError = document.getElementById('first-name-error');
const lastNameError = document.getElementById('last-name-error');
const emailError = document.getElementById('email-error');
const AgeError = document.getElementById('age-error');
const phoneError = document.getElementById('phone-error');
const addressError = document.getElementById('address-error');
const passwordError = document.getElementById('password-error');
const confirmPasswordError = document.getElementById('confirm-password-error');

const signUpButton = document.getElementById('sign-up');

signUpButton.addEventListener('click', (event) => {
    firstNameError.textContent = '';
    lastNameError.textContent = '';
    emailError.textContent = '';
    AgeError.textContent = '';
    phoneError.textContent = '';
    addressError.textContent = '';
    passwordError.textContent = '';
    confirmPasswordError.textContent = '';

    const firstNameValue = firstName.value;
    const lastNameValue = lastName.value;
    const emailValue = email.value;
    const AgeValue = Age.value;
    const phoneValue = phone.value;
    const addressValue = address.value;
    const passwordValue = password.value;
    const confirmPasswordValue = confirmPassword.value;
    
    const firsNamePattern = /^[a-zA-Z ]{3,20}$/;
    const lastNamePattern = /^[a-zA-Z ]{3,20}$/;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    const phonePattern = /^[0-9]{8}$/;

    if (firstNameValue === "") {
        firstNameError.textContent = '*First Name is required';
        firstName.focus();
        event.preventDefault();
        return;
    }else if(firstNameValue.length < 3){
        firstNameError.textContent = '*First Name must be at least 3 characters';
        firstName.focus();
        event.preventDefault();
        return;
    }else if(!firsNamePattern.test(firstNameValue)){
        firstNameError.textContent = '*First Name must contain only letters';
        firstName.focus();
        event.preventDefault();
        return;
    }
    else if(firstNameValue.length > 20){
        firstNameError.textContent = '*First Name must be at most 20 characters';
        firstName.focus();
        event.preventDefault();
        return;
    }else if(lastNameValue === "") {
        lastNameError.textContent = '*Last Name is required';
        lastName.focus();
        event.preventDefault();
        return;
    }else if(lastNameValue.length < 3){
        lastNameError.textContent = '*Last Name must be at least 3 characters';
        lastName.focus();
        event.preventDefault();
        return;
    }else if(!lastNamePattern.test(lastNameValue)){
        lastNameError.textContent = '*Last Name must contain only letters';
        lastName.focus();
        event.preventDefault();
        return;
    }
    else if(lastNameValue.length > 20){
        lastNameError.textContent = '*Last Name must be at most 20 characters';
        lastName.focus();
        event.preventDefault();
        return;
    }else if(emailValue === "") {
        emailError.textContent = '*Email is required';
        email.focus();
        event.preventDefault();
        return;
    }else if(emailPattern.test(emailValue) === false){
        emailError.textContent = '*Email must be in this format: example@domain.com';
        email.focus();
        event.preventDefault();
        return;
    }else if(AgeValue === "") {
        AgeError.textContent = '*Age is required';
        Age.focus();
        event.preventDefault();
        return;
    }else if(AgeValue < 18){
        AgeError.textContent = '*Age must be at least 18';
        Age.focus();
        event.preventDefault();
        return;
    }else if(AgeValue > 100){
        AgeError.textContent = '*Age must be at most 100';
        Age.focus();
        event.preventDefault();
        return;
    }else if(phoneValue === "") {
        phoneError.textContent = '*Phone is required';
        phone.focus();
        event.preventDefault();
        return;
    } else if(phonePattern.test(phoneValue) === false){
        phoneError.textContent = '*Phone must be 8 digits long';
        phone.focus();
        event.preventDefault();
        return;
    }else if(addressValue === "") {
        addressError.textContent = '*Address is required';
        address.focus();
        event.preventDefault();
        return;
    }else if(passwordValue === "") {
        passwordError.textContent = '*Password is required';
        password.focus();
        event.preventDefault();
        return;
    }else if(passwordValue.length < 6){
        passwordError.textContent = '*Password must be at least 6 characters';
        password.focus();
        event.preventDefault();
        return;
    }else if(passwordValue.length > 20){
        passwordError.textContent = '*Password must be at most 20 characters';
        password.focus();
        event.preventDefault();
        return;
    }else if(!passwordValue.match(/[a-z]/g) || !passwordValue.match(/[A-Z]/g) || !passwordValue.match(/[0-9]/g)){
        passwordError.textContent = '*Password must contain at least one lowercase letter, one uppercase letter and one number';
        password.focus();
        event.preventDefault();
        return;
    }else if(passwordValue !== confirmPasswordValue){
        confirmPasswordError.textContent = '*Passwords do not match';
        confirmPassword.focus();
        event.preventDefault();
        return;
    }else {
        console.log('Form submitted');
    }
});