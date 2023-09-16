
// SHOW PASSWORD
const togglePass = document.querySelector('#togglePass');
const password = document.querySelector('#_pass');
const toggleConfirm = document.querySelector('#toggleConfirm');
const confirmPassword = document.querySelector('#_confirm-pass');

togglePass.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

if(toggleConfirm) {
    toggleConfirm.addEventListener('click', function (e) {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
}

// IF CAPSLOCK IS ON
var input_pass = document.getElementById("_pass");
var pass_caps = document.getElementById("caps-pass");
var input_confirm = document.getElementById("_confirm-pass");
var pass_confirm = document.getElementById("caps-confirm");

input_pass.addEventListener("keyup", function(event) {
    (event.getModifierState("CapsLock")) ? pass_caps.style.display = "block" : pass_caps.style.display = "none"
});

if(input_confirm) {
    input_confirm.addEventListener("keyup", function(event) {
        (event.getModifierState("CapsLock")) ? pass_confirm.style.display = "block" : pass_confirm.style.display = "none"
    });
}
