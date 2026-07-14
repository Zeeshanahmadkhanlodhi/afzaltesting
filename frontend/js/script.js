let password = document.querySelector("#Password");
let confirm_password = document.querySelector("#ConfirmPassword");
let submit = document.querySelector("#submit");
let abc_username = document.querySelector("#abc_username");
let abc_email = document.querySelector("#abc_email");
console.log(password);
console.log(confirm_password);
console.log(submit);
console.log(abc_username);
console.log(abc_email);


submit.disabled = true ;


function checkform(){
    if(
        password.value !== "" &&
        password.value === confirm_password.value &&
        abc_username.value !== "" &&
        abc_email.value !== ""

    )
    { 
        submit.disabled = false
    }
    else { submit.disabled = true }
}
password.addEventListener("input" , function(){
    checkform()
})

abc_email.addEventListener("input" , function(){
    checkform()
})

abc_username.addEventListener("input" , function(){
    checkform()
})

confirm_password.addEventListener("input" , function(){
    if(password.value == confirm_password.value){
       confirm_password.classList.remove("invalid");
       confirm_password.classList.add("valid");
    }else{
       confirm_password.classList.remove("valid");
       confirm_password.classList.add("invalid");
    }
    checkform()
}

)

