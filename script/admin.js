const dashboard = document.getElementById('Dashboard');
const transactions = document.getElementById('Transactions');
const users = document.getElementById('Users');
const messages = document.getElementById('Messages');

const dashboard_section = document.getElementById('dashboard');
const transactions_section = document.getElementById('transactions');
const users_section = document.getElementById('users');
const messages_section = document.getElementById('messages');


dashboard.addEventListener('click', () => {
    dashboard_section.style.display = 'block';
    transactions_section.style.display = 'none';
    users_section.style.display = 'none';
    messages_section.style.display = 'none';
});

transactions.addEventListener('click', () => {
    dashboard_section.style.display = 'none';
    transactions_section.style.display = 'block';
    users_section.style.display = 'none';
    messages_section.style.display = 'none';
});

users.addEventListener('click', () => {
    dashboard_section.style.display = 'none';
    users_section.style.display = 'block';
    transactions_section.style.display = 'none';
    messages_section.style.display = 'none';
});

messages.addEventListener('click', () => {
    dashboard_section.style.display = 'none';
    messages_section.style.display = 'block';
    transactions_section.style.display = 'none';
    users_section.style.display = 'none';
});

const submit = document.getElementById('submit');

submit.addEventListener('click', (event) => {
    const account_number = document.getElementById('acc-num').value;
    const error_text = document.getElementById('error');

    error_text.textContent = '';
    if(isNaN(account_number)) {
        error_text.textContent = '* Account number must be a number';
        event.preventDefault();
        return;
    }else if(account_number.length !== 16) {
        error_text.textContent = '* Account number must be 16 digits';
        event.preventDefault();
        return;
    }else {
        console.log('Account number is valid');
    }

});