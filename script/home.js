const Dashboard = document.getElementById('dashboard');
const Transfer = document.getElementById('transfer');
const Deposit = document.getElementById('deposit');
const Withdraw = document.getElementById('withdraw');
const account = document.getElementById('account');

const dashboard_section = document.getElementById('Dashboard');
const transfer_section = document.getElementById('Transfer');
const deposit_section = document.getElementById('Deposit');
const withdraw_section = document.getElementById('Withdraw');
const account_section = document.getElementById('Account');

Dashboard.addEventListener('click', () => {
    dashboard_section.style.display = 'block';
    transfer_section.style.display = 'none';
    deposit_section.style.display = 'none';
    withdraw_section.style.display = 'none';
    account_section.style.display = 'none';
});

Transfer.addEventListener('click', () => {
    dashboard_section.style.display = 'none';
    transfer_section.style.display = 'block';
    deposit_section.style.display = 'none';
    withdraw_section.style.display = 'none';
    account_section.style.display = 'none';
});

Deposit.addEventListener('click', () => {
    dashboard_section.style.display = 'none';
    transfer_section.style.display = 'none';
    deposit_section.style.display = 'block';
    withdraw_section.style.display = 'none';
    account_section.style.display = 'none';
});

Withdraw.addEventListener('click', () => {
    dashboard_section.style.display = 'none';
    transfer_section.style.display = 'none';
    deposit_section.style.display = 'none';
    withdraw_section.style.display = 'block';
    account_section.style.display = 'none';
});

account.addEventListener('click', () => {
    dashboard_section.style.display = 'none';
    transfer_section.style.display = 'none';
    deposit_section.style.display = 'none';
    withdraw_section.style.display = 'none';
    account_section.style.display = 'block';
});

const deposit_button = document.getElementById('deposit-button');
const withdraw_button = document.getElementById('withdraw-button');
const transfer_button = document.getElementById('transfer-button');
const account_button = document.getElementById('account-submit-button');
const form_message = document.getElementById('send-message-button');

deposit_button.addEventListener('click', (event) => {
    const deposit_amount = document.getElementById('deposit-amount').value;
    const amount_error = document.getElementById('deposit-amount-error');
    amount_error.textContent = '';
    if (deposit_amount === '') {
        amount_error.textContent = '*Amount is required';
        event.preventDefault();
        return;
    } else if(deposit_amount <= 0) {
        amount_error.textContent = '*Amount must not be a negative number';
        event.preventDefault();
        return;
    }else if(deposit_amount < 30) {
        amount_error.textContent = '*Amount must be at least 30 TND';
        event.preventDefault();
        return;
    }else if(deposit_amount > 1000000) {
        amount_error.textContent = '*Amount must not be greater than 1,000,000 TND';
        event.preventDefault();
        return;
    }else{
        console.log(deposit_amount);
    }
});

withdraw_button.addEventListener('click', (event) => {
    const withdraw_amount = document.getElementById('withdraw-amount').value;
    const withdraw_error = document.getElementById('withdraw-amount-error');
    withdraw_error.textContent = '';
    if (withdraw_amount === '') {
        withdraw_error.textContent = '*Amount is required';
        event.preventDefault();
        return;
    } else if(withdraw_amount <= 0) {
        withdraw_error.textContent = '*Amount must not be a negative number';
        event.preventDefault();
        return;
    }else if(withdraw_amount < 30) {
        withdraw_error.textContent = '*Amount must be at least 30 TND';
        event.preventDefault();
        return;
    }else if(withdraw_amount > 1000000) {
        withdraw_error.textContent = '*Amount must not be greater than 1,000,000 TND';
        event.preventDefault();
        return;
    }else{
        console.log(withdraw_amount);
    }
});

transfer_button.addEventListener('click', (event) => {
    const account_number = document.getElementById('transfer-account-number').value;
    const transfer_amount = document.getElementById('transfer-amount').value;

    let account_number_exemple = /^[0-9]{16}$/;

    const account_number_error = document.getElementById('transfer-account-number-error');
    const transfer_amount_error = document.getElementById('transfer-amount-error');
    account_number_error.textContent = '';
    transfer_amount_error.textContent = '';
    if (account_number === '') {
        account_number_error.textContent = '*Account number is required';
        event.preventDefault();
        return;
    }else if(!account_number.match(account_number_exemple)) {
        account_number_error.textContent = '*Account number must be a 16-digit number';
        event.preventDefault();
        return;
    } else if (transfer_amount === '') {
        transfer_amount_error.textContent = '*Amount is required';
        event.preventDefault();
        return;
    } else if(transfer_amount <= 0) {
        transfer_amount_error.textContent = '*Amount must not be a negative number';
        event.preventDefault();
        return;
    }else if(transfer_amount < 30) {
        transfer_amount_error.textContent = '*Amount must be at least 30 TND';
        event.preventDefault();
        return;
    }
    else if(transfer_amount > 1000000) {
        transfer_amount_error.textContent = '*Amount must not be greater than 1,000,000 TND';
        event.preventDefault();
        return;
    }else {
        console.log(account_number, transfer_amount);
    
    }
});

account_button.addEventListener('click', (event) => {
    const first_name = document.getElementById('first-name').value;
    const last_name = document.getElementById('last-name').value;
    const email = document.getElementById('email').value;
    const age = document.getElementById('age').value;
    const address = document.getElementById('address').value;

    const firstNameError = document.getElementById('first-name-error');
    const lastNameError = document.getElementById('last-name-error');
    const emailError = document.getElementById('email-error');
    const AgeError = document.getElementById('age-error');
    const addressError = document.getElementById('address-error');

    firstNameError.textContent = '';
    lastNameError.textContent = '';
    emailError.textContent = '';
    AgeError.textContent = '';
    addressError.textContent = '';

    const first_name_pattern = /^[a-zA-Z ]{3,20}$/;
    const last_name_pattern = /^[a-zA-Z ]{3,20}$/;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    
    if(first_name === '') {
        firstNameError.textContent = '*First Name is required';
        event.preventDefault();
        return;
    }else if(first_name.length < 3) {
        firstNameError.textContent = '*First Name must be at least 3 characters';
        event.preventDefault();
        return;
    }else if(!first_name.match(first_name_pattern)) {
        firstNameError.textContent = '*First Name must contain only letters';
        event.preventDefault();
        return;
    }
    else if(first_name.length > 20) {
        firstNameError.textContent = '*First Name must be at most 20 characters';
        event.preventDefault();
        return;
    }else if(last_name === '') {
        lastNameError.textContent = '*Last Name is required';
        event.preventDefault();
        return;
    }else if(last_name.length < 3) {
        lastNameError.textContent = '*Last Name must be at least 3 characters';
        event.preventDefault();
        return;
    }else if(!last_name.match(last_name_pattern)) {
        lastNameError.textContent = '*Last Name must contain only letters';
        event.preventDefault();
        return;
    }
    else if(last_name.length > 20) {
        lastNameError.textContent = '*Last Name must be at most 20 characters';
        event.preventDefault();
        return;
    }else if(email === '') {
        emailError.textContent = '*Email is required';
        event.preventDefault();
        return;
    }else if(!email.match(emailPattern)) {
        emailError.textContent = '*Email must be like exemple@domain.com';
        event.preventDefault();
        return;
    }else if(age === '') {
        AgeError.textContent = '*Age is required';
        event.preventDefault();
        return;
    }else if(age < 18) {
        AgeError.textContent = '*Age must be at least 18 years';
        event.preventDefault();
        return;
    }else if(address === '') {
        addressError.textContent = '*Address is required';
        event.preventDefault();
        return;
    }else {
        console.log(first_name, last_name, email, age, phone);
    }
});



form_message.addEventListener('click', (event) => {
    const email = document.getElementById('contact-email').value;
    const subject = document.getElementById('subject').value;
    const message = document.getElementById('message').value;

    const email_error = document.getElementById('contact-email-error');
    const subject_error = document.getElementById('contact-select-error');
    const message_error = document.getElementById('contact-message-error');

    email_error.textContent = '';
    subject_error.textContent = '';
    message_error.textContent = '';

    let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (email === '') {
        email_error.textContent = '*Email is required';
        event.preventDefault();
        return;
    } else if(!email.match(emailPattern)) {
        email_error.textContent = '*Email must be like exemple@domain.com';
        event.preventDefault();
        return;
    } else if (subject === '') {
        subject_error.textContent = '*You must select a subject';
        event.preventDefault();
        return;
    }
    else if (message === '') {
        message_error.textContent = '*Message is required';
        event.preventDefault();
        return;
    } else if(message.length < 10) {
        message_error.textContent = '*Message must be at least 10 characters';
        event.preventDefault();
        return;
    } else if(message.length > 100) {
        message_error.textContent = '*Message must be at most 100 characters';
        event.preventDefault();
        return;
    } else {
        console.log(email,subject,message);
    }
});