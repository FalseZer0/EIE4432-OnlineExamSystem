function submitForm() {
    let magic = document.querySelector("#mgc")
    let pass = document.querySelector("#password")
    let cpass = document.querySelector("#conf_password")
    let uid = document.querySelector("#userid")

    if (uid.value == "") {
        alert("Please enter the id number")
        return false;
    }
    if (pass.value == "" || cpass.value == "") {
        alert("Password fields cant be blank!")
        return false;
    }
    else if (pass.value != cpass.value) {
        alert("Passwords do not match!")
        return false;
    }
    if (magic.value == "") {
        alert("Please enter the magic number")
        return false;
    }
    else if (magic.value.length < 5) {
        alert("Magic number should be 5 digits long")
        return false;
    }
    else if (!intRegex.test(magic.value)) {
        alert("Magic number should consist of digits only!")
        return false;
    }


    return true;
}