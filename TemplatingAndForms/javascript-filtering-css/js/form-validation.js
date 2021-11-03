function validate(){
    var check = {};
    check.errorMsg = "";
    check.result = true;

    // Validate Username
    var usernameObj = usernameValidation();
    if (!usernameObj.result){
        check.errorMsg += usernameObj.error;
        check.result = false;
    }

    // Validate Password
    var passObj = passwordValidation();
    if (!passObj.result){
        check.errorMsg += passObj.error;
        check.result = passObj.result;
    }

    // Validate Email
    var emailObj = emailValidation();
    if (!emailObj.result){
        check.errorMsg += emailObj.error;
        check.result = emailObj.result;
    }

    // Update the help block div with the errorMsg
    document.getElementById("errors").innerHTML = "<p>" + check.errorMsg + "</p>";
    
    // At this point the form should be valid
    if (check.result){
        document.getElementById("register").disabled = false;
    }
}

function emailValidation(){
    var emailInput = document.getElementById("email").value;

    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    var obj = {};
    obj.error = '';
    obj.result = true;

    if (!emailInput.match(emailRegex)){
        obj.error = "* Email is required.<br>";
        obj.result = false;
    }

    return obj;
}

function usernameValidation(){
    var usernameInput = document.getElementById("username").value;

    var obj = {};
    obj.error = '';
    obj.result = true;

    if (usernameInput.length < 3){
        obj.error = "* Username must contain at least 3 characters.<br>";
        obj.result = false;
    }

    return obj;
}

// Base functionality credited to: https://stackoverflow.com/a/17152963
function passwordValidation(){
    var password = document.getElementById("password").value;

    var anUpperCase = /[A-Z]/;
    var aLowerCase = /[a-z]/; 
    var aNumber = /[0-9]/;
    var aSpecial = /[!|@|#|$|%|^|&|*|(|)|-|_]/;

    var obj = {};
    obj.error = '';
    obj.result = true;

    if (password.length < 8 || password.length > 20){
        obj.result=false;
        obj.error="* Password length is incorrect, it must be between 8-20 characters long.<br>"
        return obj;
    }

    var numUpper = 0;
    var numLower = 0;
    var numNums = 0;
    var numSpecials = 0;
    for (var i = 0; i < password.length; i++){
        if (anUpperCase.test(password[i]))
            numUpper++;
        else if (aLowerCase.test(password[i]))
            numLower++;
        else if (aNumber.test(password[i]))
            numNums++;
        else if (aSpecial.test(password[i]))
            numSpecials++;
    }

    if (numUpper < 2 || numLower < 2 || numNums < 2 || numSpecials <2){
        obj.result=false;
        obj.error="* Password format is incorrect. It must contain:<br>" +
                "   2 Uppercase Letters (A-Z)<br>" +
                "   2 Lowercase Letters (a-z)<br>" +
                "   2 Numbers (0-9)<br>" +
                "   2 Special Characters (!, @, #, $, %, ^, &, *, (, ), -, _)<br>";
        return obj;
    }
    return obj;
}


