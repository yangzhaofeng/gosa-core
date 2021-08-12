// Disable default event for scrolling the card
let scrollElem = document.querySelectorAll('.card-content-scroll');

if (scrollElem.length !== 0) {
    let cardContent = document.querySelector('.card-content');
    cardContent.style.overflowY = "hidden"
}

// Function to change the visibility of the password
document.querySelectorAll('.toggle-pw').forEach(icon => {
    icon.addEventListener('click', function() {
        let input = this.parentElement.querySelector('input');

        if (input.getAttribute('type') == 'password') {
            input.setAttribute('type', 'text');
            icon.innerText = "visibility_off";
        } else {
            input.setAttribute('type', 'password');
            icon.innerText = "visibility";
        }
    })
});

// Check password conditions
var input = document.getElementById("new_password");
var pwLength = document.getElementById("pw-length");
var pwLowercase = document.getElementById("pw-lowercase");
var pwUppercase = document.getElementById("pw-uppercase");
var pwNumbers = document.getElementById("pw-numbers");
var pwSpecial = document.getElementById("pw-special");
let pwStrength = [false, false, false, false, false];
var pwButton = document.getElementById("password_finish")

// When the user starts to type something inside the password field
input.onkeyup = function() {
    testPasswordCss(input.value);

    // Validate length
    if (input.value.length >= 8) {
        pwLength.innerText = "check";
        pwLength.style.color = "green";
        pwStrength[0] = true;
    } else {
        pwLength.innerText = "close";
        pwLength.style.color = "red";
        pwStrength[0] = false;
    }

    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (input.value.match(lowerCaseLetters)) {
        pwLowercase.innerText = "check";
        pwLowercase.style.color = "green";
        pwStrength[1] = true;
    } else {
        pwLowercase.innerText = "close";
        pwLowercase.style.color = "red";
        pwStrength[1] = false;
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (input.value.match(upperCaseLetters)) {
        pwUppercase.innerText = "check";
        pwUppercase.style.color = "green";
        pwStrength[2] = true;
    } else {
        pwUppercase.innerText = "close";
        pwUppercase.style.color = "red";
        pwStrength[2] = false;
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (input.value.match(numbers)) {
        pwNumbers.innerText = "check";
        pwNumbers.style.color = "green";
        pwStrength[3] = true;
    } else {
        pwNumbers.innerText = "close";
        pwNumbers.style.color = "red";
        pwStrength[3] = false;
    }

    // Validate numbers
    var specialChars = /[!,@,#,$,%,^,&,*,?,_,~]/g;
    if (input.value.match(specialChars)) {
        pwSpecial.innerText = "check";
        pwSpecial.style.color = "green";
        pwStrength[4] = true;
    } else {
        pwSpecial.innerText = "close";
        pwSpecial.style.color = "red";
        pwStrength[4] = false;
    }

    if (pwStrength.every(Boolean)) {
        pwButton.disabled = false;
    } else {
        pwButton.disabled = true;
    }
}