import './bootstrap';
// Import CSS for intl-tel-input
// Import CSS for intl-tel-input
import 'intl-tel-input/build/css/intlTelInput.css';

// Import intl-tel-input
import intlTelInput from 'intl-tel-input';

// Initialize intl-tel-input on the phone input
document.addEventListener('DOMContentLoaded', function () {
    const input = document.querySelector('#phone');
    if (input) {
        intlTelInput(input, {
            // Add your options here
        });
    }
});

