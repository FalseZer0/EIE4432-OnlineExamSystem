let intRegex = /^([+-]?[1-9]\d*|0)$/;
function submitForm() {
    let uid = document.querySelector("#userid");
    let pass = document.querySelector("#password");
    if (uid.value == "") {
        alert("id Cant be blank")
        return false;
    }
    else if (!intRegex.test(uid.value)) {
        alert("ID should consist of integers only")
        return false;
    }
    else if (uid.value.length < 8) {
        alert("ID should be 8 digits long")
        return false;
    }
    if (pass.value == "") {
        alert("password fields cant be blank")
        return false;
    }

    return true;
}