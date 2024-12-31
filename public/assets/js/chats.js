const emailContainer = document.getElementById('email-container');
const emailInput = document.getElementById('email-input');
const emailDisplay = document.getElementById('email-display');
const storedEmailElement = document.getElementById('stored-email');
const emailExistsMessage = document.getElementById('email-exists-message');
const removeEmailBtn = document.getElementById('remove-email-btn');

// Check if email exists in localStorage on page load
if (localStorage.getItem('email')) {
    const storedEmail = localStorage.getItem('email');
    emailDisplay.style.display = 'block';
    storedEmailElement.textContent = storedEmail;
    emailContainer.style.display = 'none';
    emailExistsMessage.style.display = 'block';
    emailInput.setAttribute('readonly', true);
    removeEmailBtn.style.display = 'inline-block';
} else {
    // If no email stored, show the email input and hide the message
    emailContainer.style.display = 'block';
    emailDisplay.style.display = 'none';
    emailExistsMessage.style.display = 'none';
}

// Remove the email from localStorage
removeEmailBtn.addEventListener('click', function () {
    localStorage.removeItem('email');
    emailInput.removeAttribute('readonly');
    emailContainer.style.display = 'block';
    emailDisplay.style.display = 'none';
    emailExistsMessage.style.display = 'none';
    removeEmailBtn.style.display = 'none';
    emailInput.value = ''; 
});

// Save the email to localStorage when input changes
emailInput.addEventListener('input', function () {
    localStorage.setItem('email', emailInput.value);
});
