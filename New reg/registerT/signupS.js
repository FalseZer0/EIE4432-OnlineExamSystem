let buttoncount = 0;
let intRegex = /^([+-]?[1-9]\d*|0)$/
function createError(text){
    let p = document.createElement('p');
    p.innerHTML = text;
    p.classList.add("error_message")
    return p;
}

function emailIsValid (email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}


function submitForm()
{
    
    let uid = document.querySelector("#userid")
    let pass = document.querySelector("#password");
    let cpass = document.querySelector("#conf_password")
    let lname = document.querySelector("#lastname");
    let fname = document.querySelector("#firstname")
    let email = document.querySelector("#email")
    let bday = document.querySelector("#bdayinput");
    let male = document.querySelector("#male")
    let female = document.querySelector("#female")
    let fileup = document.querySelector("#fileup")
    let magic = document.querySelector("#magic")
    if(uid.value==""){
        alert("id Cant be blank")
        return false;
    }
    else if(!intRegex.test(uid.value))
    {
        alert("ID should consist of integers only")
        return false;
    }  
    else if(uid.value.length<8)
    {
        alert("ID should be 8 digits long")
        return false;
    }
    
    if(lname.value==""){
        alert("Last Name Cant be blank")
        return false;
    }
    if(fname.value==""){
        alert("First Name Cant be blank")
        return false;
    }
    if(pass.value=="" || cpass.value==""){
        alert("password fields cant be blank")
        return false;
    }
    else if(pass.value!=cpass.value){
        alert("passwords dont match")
        return false;
    }
    if(fileup.value=="")
    {
        alert("Please upload an image")
        return false;
    }
    if(email.value=="")
    {
        alert("Email cant be blank")
        return false
    }
    else if(!emailIsValid(email.value))
    {
        alert("Email is not valid")
        return false
    }
    if(bday.value=="")
    {
        alert("Birthday cant be blank")
        return false
    }
    if(!male.checked&&!female.checked)
    {
        alert("Please indicate your gender")
        return false;
    }
    
    if(magic.value=="")
    {
        alert("Please enter the magic number")
        return false;
    }
    else if(magic.value.length<5)
    {
        alert("Magic number should be 5 digits long")
        return false;
    }
    else if(!intRegex.test(magic.value))
    {
        alert("Magic number should consist of digits only!")
        return false;
    }
        

    return true;
}
