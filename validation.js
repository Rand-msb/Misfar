// function that validate form inputs 
function validateForm() {
    rev = document.forms["revForm"]["rev"].value;
    var num = document.getElementById("files");
    y = num.files.length;
    if (rev === "") {
        ShowErrorAdd("You cannot submit an empty review");
    } else if (y > 2) {
        ShowErrorAdd("only 2 attachments are allowed");
    } else {
        ShowErrorAdd("");

    }

}
//
//function validateForm2() {
//    dec = document.forms["request2"]["dec"].value;
//    var num = document.getElementById("files2");
//    y = num.files.length;
//    if (dec == '') {
//        ShowErrorAdd("Please enter description.");
//    } else if (y > 2) {
//        ShowErrorAdd("only 2 attachments are allowed");
//    } else {
//        ShowErrorAdd("");
//    }
//
//}

function ShowErrorAdd(errorMsg) {
    Error = document.getElementById('Error2');
    ErrorIcon = document.getElementById("ErrorIcon2")
    if (errorMsg != "") {
        Error.style.color = "#3A1988";
        ErrorIcon.style.display = "inline";
        ErrorIcon.style.marginLeft = "160px";
        Error.innerHTML = errorMsg;
    } else {
        Error.innerHTML = errorMsg;
        ErrorIcon.style.display = "none";
        ErrorIcon.style.marginLeft = "9px";


        alertf();
        //redirect();
    }

}

// function that validate file type there is another way to validate is via html file so what should i choose?
function fileValidation() {

    var fileInput = document.getElementById("files");
    var filePath = fileInput.value;
    // Allowing file type
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        ShowErrorAdd("Invalid file type");
        fileInput.value = "";
        return false;
    } else {
        Error.innerHTML = "";
        ErrorIcon.style.display = "none";
        return true;
    }
}

//function fileValidation2() {
//    Error = document.getElementById('Error2');
//    ErrorIcon = document.getElementById("ErrorIcon2");
//
//    var fileInput = document.getElementById("files2");
//    var filePath = fileInput.value;
//    // Allowing file type
//    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i;
//
//    if (!allowedExtensions.exec(filePath)) {
//        ShowErrorAdd("Invalid file type");
//        fileInput.value = "";
//        return false;
//    } else {
//        Error.innerHTML = "";
//        ErrorIcon.style.display = "none";
//        return true;
//    }

//}