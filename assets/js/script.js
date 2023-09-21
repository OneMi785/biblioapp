// Sélection des éléments du DOM
const menuBtn = document.querySelectorAll('.switch-row');

// Ajout de la classe row sous 769px
document.addEventListener('DOMContentLoaded', () => {
    if (window.innerWidth < 769) {
        menuBtn.forEach(btn => {
            btn.classList.add('row');
        })
    }
})


        // Regex to check if password contains at least 1 uppercase, 1 lowercase, 1 number and 1 special character and is at least 8 characters long
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        // Regex to check if the 2 passwords match
        const passwordCheckRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        // Get the password input
        const passwordInput = document.getElementById('registration_form_plainPassword');

        // Get the password help block
        const passwordHelpBlock = document.getElementById('passwordHelpBlock');

        // Display an error message in a div  while the user types his password if it doesn't match the regex
        passwordInput.addEventListener('input', () => {
            if (!passwordRegex.test(passwordInput.value)) {
                passwordInput.classList.add('is-invalid');
                passwordInput.classList.remove('is-valid');
                passwordHelpBlock.classList.remove('visually-hidden');
            } else {
                passwordInput.classList.add('is-valid');
                passwordInput.classList.remove('is-invalid');
                passwordHelpBlock.classList.add('visually-hidden');
            }
        });