/******************************Add attraction******************************/
function showPreview(event) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("file-ip-1-preview");
        var icon = document.getElementById("uplode-icon");
        var par = document.getElementById("uplode-par");
        preview.src = src;
        preview.style.display = "block";
        icon.style.display = "none";
        par.style.display = "none";
    }
}

function validateForm() {
    var img = document.getElementById("file-ip-1-preview");
    var title = document.forms["addAtractForm"]["title"].value;
    var Category = document.forms["addAtractForm"]["Category"].value;
    var decs = document.forms["addAtractForm"]["desc"].value;
    var city = document.forms["addAtractForm"]["city"].value;
    if (title == '') {
        ShowErrorAdd("Please enter a title.");
    } else if (Category == '') {
        ShowErrorAdd("Please enter a Category.");
    } else if (decs == '') {
        ShowErrorAdd("Please enter a description.");
    } else if (city == '') {
        ShowErrorAdd("Please choose a city.");
    } else if (img.src == '') {
        ShowErrorAdd("Please Upload an image.");
    } else {
        ShowErrorAdd("");
    }

}

function ShowErrorAdd(errorMsg) {
    Error = document.getElementById('Error');
    ErrorIcon = document.getElementById("ErrorIcon")
    if (errorMsg != "") {
        Error.style.color = "#9989a5";
        ErrorIcon.style.display = "inline";
        Error.innerHTML = errorMsg;
    } else {
        Error.innerHTML = errorMsg;
        ErrorIcon.style.display = "none";
        alrt();
    }
}