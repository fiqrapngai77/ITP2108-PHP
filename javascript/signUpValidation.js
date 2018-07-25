/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validateForm(){
    var user = document.forms["signUpForm"]["user"].value;
    var password = document.forms["signUpForm"]["password"].value;
    var cPassword = document.forms["signUpForm"]["cPassword"].value;
    
    var alphanumeric = new RegExp("[^a-zA-Z0-9]");
    
    var flag = 0;
    document.getElementById("usernameWarning").style.display = "none";
    document.getElementById("passwordWarning").style.display = "none";
    document.getElementById("cPasswordWarning").style.display = "none";
    document.getElementById("shortPasswordWarning").style.display = "none";
    document.getElementById("specialCharPasswordWarning").style.display = "none";
    
    if(user == ""){
        document.getElementById("usernameWarning").style.display = "block";
        flag = 1;
    }
    
    if(password == ""){
        document.getElementById("passwordWarning").style.display = "block";
        flag = 1;
    }else if(password.length <8){
        document.getElementById("shortPasswordWarning").style.display = "block";
        flag=1;
    }
    
    if(alphanumeric.test(password)){
        document.getElementById("specialCharPasswordWarning").style.display = "block";
        flag=1;
    }
    
    if(cPassword != password){
        document.getElementById("cPasswordWarning").style.display = "block";
        flag = 1;
    }
    
    if(flag==1){
        return false;
    }
}
