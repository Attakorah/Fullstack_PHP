var gVar = "Hello";
console.log(gVar);

function myFunc() {
    var gVar = "World";
    console.log(gVar);
}
myFunc();
console.log(gVar);

function theFunc() {
    var localVar = "I am local";
    console.log(localVar);
}

theFunc();
console.log(localVar); // This will give an error because localVar is not defined in the global scope.