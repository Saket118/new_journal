function validateForm() {

    const fields = [
        {
            id: "title",
            required: "Please Select Title"
        },
        {
            id: "fullName",
            required: "Please Enter Full Name"
        },
        {
            id: "email",
            required: "Please Enter Email",
            pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
            invalid: "Please Enter Valid Email"
        },
        {
            id: "password",
            required: "Please Enter Password",
            pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/,
            invalid: "Password must be strong & Min 6 chars long"
        },
        {
            id: "userType",
            required: "Please Select User Type"
        },
        {
            id: "country",
            required: "Please Select Country"
        },
        {
            id: "contact",
            required: "Please Enter Contact Number",
            pattern: /^[0-9]{10}$/,
            invalid: "Please Enter Valid 10 Digit Mobile Number"
        },
        {
            id: "address",
            required: "Please Enter Address"
        }
    ];

    clearErrors();

    for (const field of fields) {

        const input = document.getElementById(field.id);
        if (!input) continue;

        const value = input.value.trim();

        if (!value) {
            showError(input, field.required);
            return false;
        }

        if (field.pattern && !field.pattern.test(value)) {
            showError(input, field.invalid);
            return false;
        }
    }
    // alert("Form Submitted Successfully!");
    return true;
}

function showError(input, message) {
    input.focus();
    input.classList.add("is-invalid");

    const error = document.getElementById(input.id + "Error");
    if (error) {
        error.textContent = message;
    }
}

function clearErrors() {
    document.querySelectorAll("[id$='Error']").forEach(error => {
        error.textContent = "";
    });

    document.querySelectorAll(".is-invalid").forEach(input => {
        input.classList.remove("is-invalid");
    });
}



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