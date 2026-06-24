var catObject = {
    name: "Zowee",
    type: "Siamese",
    legs: 4,
    makeSound:function(){
        console.log("The cat said, meeow!");
    }
}

catObject.makeSound = function(sound){
    console.log("The cat said: "+sound)
}

catObject.makeSound("Woof!");

var studentInfo = {
    studentName: "John Bull",
    age: 17,
    isAdmitted: true,
    hobbies: ['reading','gaming','running'],
    greeting:function(endWorld){
        console.log("The student said, " + endWorld);
    }
}

studentInfo.greeting = function(theGreeting, time){
    console.log("The student said, "+ theGreeting + ", this "+time);
}

studentInfo.greeting("Hi!","Morning");