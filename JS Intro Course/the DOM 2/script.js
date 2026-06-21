/**var myDiv = document.createElement('div');

var parentEl = document.querySelector('body');

parentEl.appendChild(myDiv);*/
/**
function printText(){
    console.log("Startocode Rocks");
}

function alertText(){
    alert("JavaScript is cool");
}
*/
//setTimeout(alertText, 4000);

//setInterval(printText, 3000);
/** 
function domManipulation(){
    //Add a New Div
    var newDiv = document.createElement('div');
    newDiv.style.backgroundColor = 'red';
    newDiv.style.width = '200px';
    newDiv.style.height = '80px';

    var bodyVar = document.querySelector('body');
    bodyVar.appendChild(newDiv);

    //Add h2 Element
    var newH2 = document.createElement('h2');
    newH2.style.color = 'white';

    var h1Text = document.getElementById('head1').innerHTML;

    newH2.innerHTML = h1Text;

    document.querySelector('div').appendChild(newH2);

    //Add paragraph Element
    var newPara = document.createElement('p');
    newPara.style.color = 'white';

    var oldParaText = document.getElementById('para1').innerHTML;

    newPara.innerHTML = oldParaText;

    document.querySelector('div').appendChild(newPara);
}

setTimeout(domManipulation, 4000);
*/
/** 
function changeBgColor(){
    var theDiv = document.getElementById('mainDiv');
    theDiv.style.backgroundColor = 'green';
}

var theBtn = document.getElementById('eventBtn');
theBtn.onclick = changeBgColor;
*/
/** 
function changeText1(){
    document.getElementById('head1').innerHTML = "Button Bouble Clicked";
}

function changeText2(){
    document.getElementById('head1').innerHTML = "Mouse Moved Over Button";
}

var theBtn = document.getElementById('eventBtn');
theBtn.ondblclick = changeText1;

theBtn.onmouseover = changeText2;
*/
/** 
function realTimeText(){
    var theInput = document.getElementById('inputBox').value;
    document.getElementById('para1').innerHTML = theInput;
} */
/** 
function emailValidation(){
    var emailInput = document.getElementById("emailInput");
    var emailError = document.getElementById('emailError');

    if(emailInput.value == ""){
        emailInput.style.borderColor = "red";
        emailError.innerHTML = "please enter an email";
    }else if(!emailInput.value.includes("@")){
        emailInput.style.borderColor = "red";
        emailError.innerHTML = "Invalid email";
    }else{
         emailInput.style.borderColor = "green";
        emailError.innerHTML = "";
    }
}

function passwordValidation(){
    var passInput1 = document.getElementById("passInput1");
    var passError1 = document.getElementById("passwordError");

    if(passInput1.value == ""){
        passInput1.style.borderColor = "red";
        passError1.innerHTML = "please enter password";
    }else{
         passInput1.style.borderColor = "green";
        passError1.innerHTML = "";
    }
}

function confirmPasswordValidation(){
    var passInput1 = document.getElementById("passInput1");
    var passInput2 = document.getElementById("passInput2");
    var passError2 = document.getElementById("confirmPasswordError");

    if(passInput2.value == ""){
        passInput2.style.borderColor = "red";
        passError2.innerHTML = "please enter password";
    }else if(passInput1.value != passInput2.value){
        passInput2.style.borderColor = "red";
        passError2.innerHTML = "Passwords do not match";
    }else{
        passInput2.style.borderColor = "green";
        passError2.innerHTML = "";
    }
}
*/

