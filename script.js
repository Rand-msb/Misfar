
function show() {
    document.querySelector(".popup-signup").classList.remove("activesignup");

    document.querySelector(".popup").classList.add("active");
    document.getElementById('Error1').style.display = "none";

    document.forms["myForm"]["username"].value = "";
    document.forms["myForm"]["password"].value = "";


}
function hide() {
    document.querySelector(".popup").classList.remove("active");
    document.getElementById('Error1').style.display = "none";
    document.forms["myForm"]["username"].value = "";
    document.forms["myForm"]["password"].value = "";

}
function shows() {
    document.querySelector(".popup").classList.remove("active");

    document.querySelector(".popup-signup").classList.add("activesignup");
    document.getElementById('Error').style.display = "none";
    document.forms["myForm2"]["username"].value = "";
    document.forms["myForm2"]["password"].value = "";
    document.forms["myForm2"]["email"].value = "";
    document.forms["myForm2"]["name"].value = "";

}
function hides() {
    document.querySelector(".popup-signup").classList.remove("activesignup");
    document.getElementById('Error').style.display = "none";
    document.forms["myForm2"]["username"].value = "";
    document.forms["myForm2"]["password"].value = "";
    document.forms["myForm2"]["email"].value = "";
    document.forms["myForm2"]["name"].value = "";

}


function ShowError1(errorMsg) {
    document.getElementById('Error1').style.display = "inline";

    Error = document.getElementById('Error1');
    ErrorIcon = document.getElementById("ErrorIcon")
    if (errorMsg != "") {
        Error.style.color = "#bd1c1c";
        Error.style.padding = " 13px";
        Error.style.fontWeight = "700";
        Error.style.fontSize = "12px";

        Error.innerHTML = errorMsg;
    }
    else {
        Error.innerHTML = errorMsg;
        ErrorIcons.style.display = "none";
    }
}

function EmpLoginForm() {



    username = document.forms["myForm"]["username"].value;
    Pass = document.forms["myForm"]["password"].value;

    if (username == '' || Pass == '')
        ShowError1("Please enter all fields.");
    else if ((/[0-9]/).test(username))
        ShowError1("Username must not contain digits");
    else if (validatePass1("myForm"))
        ShowError1("");

}
//Validate Password:
function validatePass1(formID) {
    Pass = document.forms[formID]["password"].value;

    if (Pass.length < 8)
        ShowError1("Password must be at least 8 characters.");
    else if (Pass.search(/[a-z]/) < 0)
        ShowError1("Password must contain at least one small letter.");
    else if (Pass.search(/[A-Z]/) < 0)
        ShowError1("Password must contain at least one capital letter.");
    else if (Pass.search(/[0-9]/) < 0)
        ShowError1("Password must contain at least one digit.");
    else
        return true;

}
function validatePass(formID) {
    Pass = document.forms[formID]["password"].value;

    if (Pass.length < 8)
        ShowError("Password must be at least 8 characters.");
    else if (Pass.search(/[a-z]/) < 0)
        ShowError("Password must contain at least one small letter.");
    else if (Pass.search(/[A-Z]/) < 0)
        ShowError("Password must contain at least one capital letter.");
    else if (Pass.search(/[0-9]/) < 0)
        ShowError("Password must contain at least one digit.");
    else
        return true;

}
function ShowError(errorMsg) {
    document.getElementById('Error').style.display = "inline";

    Error = document.getElementById('Error');
    ErrorIcon = document.getElementById("ErrorIcon")
    if (errorMsg != "") {
        Error.style.color = "#bd1c1c";
        Error.style.padding = " 13px";
        Error.style.fontWeight = "700";
        Error.style.fontSize = "12px";

        Error.innerHTML = errorMsg;
    }
    else {
        Error.innerHTML = errorMsg;
        ErrorIcons.style.display = "none";
    }
}



function EmpSignupForm() {

    x = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    username = document.forms["myForm2"]["username"].value;
    Pass = document.forms["myForm2"]["password"].value;
    email = document.forms["myForm2"]["email"].value;
    name1 = document.forms["myForm2"]["name"].value;



    if (username == '' || Pass == '' || email == '' || name1 == '')
        ShowError("Please enter all fields.");
    else if ((/[0-9]/).test(name1))
        ShowError("name must not contain digits");
    else if ((/[0-9]/).test(username))
        ShowError("Username must not contain digits");
    else if (x.test(email) == false)
        ShowError("Invalid email");
    else if (validatePass("myForm2"))
        ShowError("");
}

