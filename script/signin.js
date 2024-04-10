const email = document.getElementById('email');
const emailError = document.getElementById('email-error');
const password = document.getElementById('password');
const passwordError = document.getElementById('password-error');
const signInButton = document.getElementById('signin');

signInButton.addEventListener('click', (event) => {
    emailError.textContent = '';
    passwordError.textContent = '';

    const emailValue = email.value;
    const passwordValue = password.value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;


    if (emailValue === "") {
        emailError.textContent = '*Email is required';
        email.focus();
        event.preventDefault();
        return;
    }else if(emailPattern.test(emailValue) === false){
        emailError.textContent = '*Email must be in this format: example@domain.com';
        email.focus();
        event.preventDefault();
        return;
    }else if(passwordValue === "") {
        passwordError.textContent = '*Password is required';
        password.focus();
        event.preventDefault();
        return;
    }
    else if(passwordValue.length < 6){
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
    }else{
        console.log('Data is valid');
    }
});

