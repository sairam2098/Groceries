function toggleForm() {
    var loginForm = document.getElementById("loginForm");
    var registerForm = document.getElementById("registerForm");

    if (loginForm.style.display === "none") {
        loginForm.style.display = "block";
        registerForm.style.display = "none";
    } else {
        loginForm.style.display = "none";
        registerForm.style.display = "block";
    }
}

function isValidDateFormat(dateString) {
    var regex = /^(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])-\d{4}$/;

    return regex.test(dateString);
}

function testDate(dateString) {
    if (isValidDateFormat(dateString)) {
        return true;
    } else {
        return false;
    }
}

function calculateAge(dateOfBirthString) {
    var dob = dateOfBirthString.split('-');

    var dobMonth = parseInt(dob[0]);
    var dobDay = parseInt(dob[1]);
    var dobYear = parseInt(dob[2]);

    var currentDate = new Date();

    var currentYear = currentDate.getFullYear();
    var currentMonth = currentDate.getMonth() + 1;
    var currentDay = currentDate.getDate();

    var age = currentYear - dobYear;

    if (currentMonth < dobMonth || (currentMonth === dobMonth && currentDay < dobDay)) {
        age--;
    }

    return age;
}