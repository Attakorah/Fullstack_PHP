var catObject = {
    name:"Zowee",
    type:"Siamese",
    legs:4
}

catObject.type = "Persian";
catObject.legs = catObject.legs - 1;
console.log(catObject.legs);

//modifying objects arrays
var studentInfo = {
    studentName:"Emmanuel Attakorah",
    age:20,
    admitted: true,
    hobbies: ['reading','gaming','running']
}

studentInfo.hobbies[2] = "hiking";
studentInfo.hobbies.push("Swimming");
console.log(studentInfo.hobbies);