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
