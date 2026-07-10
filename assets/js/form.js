function validateForm() {

    clearErrors();

    var title = document.getElementById("title");
    var fullName = document.getElementById("fullName");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var userType = document.getElementById("userType");
    var country = document.getElementById("country");
    var contact = document.getElementById("contact");
    var address = document.getElementById("address");

    if (title.value.trim() === "") {
        showError(title, "Please Select Title");
        return false;
    }
    if (fullName.value.trim() === "") {
        showError(fullName, "Please Enter Full Name");
        return false;
    }
    if (email.value.trim() === "") {
        showError(email, "Please Enter Email");
        return false;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
        showError(email, "Please Enter Valid Email");
        return false;
    }
    if (password.value.trim() === "") {
        showError(password, "Please Enter Password");
        return false;
    }
    if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/.test(password.value.trim())) {
        showError(password, "Password must be strong & minimum 6 characters long");
        return false;
    }
    if (userType.value.trim() === "") {
        showError(userType, "Please Select User Type");
        return false;
    }
    if (country.value.trim() === "") {
        showError(country, "Please Select Country");
        return false;
    }
    if (contact.value.trim() === "") {
        showError(contact, "Please Enter Contact Number");
        return false;
    }
if (contact.value.trim().length < 10 || contact.value.trim().length > 12) {
    showError(contact, "Mobile Number should be 10 to 12 digits only");
    return false;
}
    if (address.value.trim() === "") {
        showError(address, "Please Enter Address");
        return false;
    }
    return true;
}

function showError(element, message) {
    element.classList.add("is-invalid");
    element.focus();
    var error = document.getElementById(element.id + "Error");
    if (error) {
        error.innerHTML = message;
    }
}

function clearErrors() {
    document.querySelectorAll(".is-invalid").forEach(function (element) {
        element.classList.remove("is-invalid");
    });
    document.querySelectorAll(".invalid-feedback").forEach(function (element) {
        element.innerHTML = "";
    });
}


document.getElementById("fullName").addEventListener("input", function () {
    this.value = this.value.replace(/[^A-Za-z ]/g, "");
});
document.getElementById("contact").addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, "").slice(0, 12);
});



///////////////TOC Alert & Email Alert////////////////////
function subscribe(inputId, errorId, successId, successMessage) {

    const email = document.getElementById(inputId);
    const error = document.getElementById(errorId);
    const success = document.getElementById(successId);

    email.classList.remove("is-invalid");
    error.textContent = "";
    success.textContent = "";

    const value = email.value.trim();

    if (!value) {
        email.classList.add("is-invalid");
        error.textContent = "Please Enter Email";
        email.focus();
        return false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(value)) {
        email.classList.add("is-invalid");
        error.textContent = "Please Enter Valid Email";
        email.focus();
        return false;
    }

    const categoryValue = (inputId === 'tocEmail') ? 'TOC Alert' : 'Email Alert';

    fetch("ajax.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            action: 'add_subscriber',
            email: value,
            category: categoryValue
        })
    })
        .then(res => res.text())
        .then(data => {
            if (data.trim() === "success") {
                success.textContent = successMessage;
                email.value = "";
            } else {
                error.textContent = "Database error. Please try again.";
            }
        })
        .catch(err => {
            console.error(err);
            error.textContent = "Server error. Please try again later.";
        });

    return true;
}