document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.needs-validation').forEach(form => {
        const fields = form.querySelectorAll('input[required], select[required], textarea[required]');

        // Phone input: allow only digits
        const phoneField = form.querySelector('input[type="tel"]');
        if (phoneField) {
            phoneField.addEventListener('input', (e) => {
                e.target.value = e.target.value.replace(/\D/g, '');
            });
        }

        // Password match validation
        const checkPasswordMatch = () => {
            const password = form.querySelector('#password');
            const passwordConfirm = form.querySelector('#password_confirm');
            const passwordConfirmError = form.querySelector('#password_confirm_error');

            if (!password || !passwordConfirm || !passwordConfirmError) return;

            const match = password.value === passwordConfirm.value;

            passwordConfirm.classList.toggle('is-invalid', !match);
            passwordConfirm.classList.toggle('is-valid', match);
            passwordConfirmError.style.display = match ? 'none' : 'block';

            passwordConfirm.setCustomValidity(match ? '' : 'Passwords do not match');
        };

        const validateField = (field) => {
            const errorElement = form.querySelector(`#${field.id}_error`);
            if (!errorElement) {
                return;
            }

            const isValid = field.checkValidity();
            field.classList.toggle('is-invalid', !isValid);
            field.classList.toggle('is-valid', isValid);
            errorElement.style.display = isValid ? 'none' : 'block';
        };

        form.addEventListener('input', (e) => {
            if (e.target && e.target.tagName !== 'BUTTON') {
                validateField(e.target);

                if (['password', 'password_confirm'].includes(e.target.id)) {
                    checkPasswordMatch();
                }
            }
        });

        form.addEventListener('submit', (e) => {
            let isValid = true;

            checkPasswordMatch(); // Make sure passwords match before checking all

            fields.forEach(field => {
                if (field.willValidate) {
                    validateField(field);
                    if (!field.checkValidity()) {
                        isValid = false;
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
                e.stopPropagation();
            }

            form.classList.add('was-validated');
        });
    });
});
