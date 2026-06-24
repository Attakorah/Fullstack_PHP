// let num = 2;

// while (num > 0) {
//     console.log("The number " + num + " is greater than 0");
//     num--;
// }

let guessedNumber = Math.floor(Math.random() * 10) + 1;
let userInput = 4;

console.log(guessedNumber);
while (guessedNumber !== userInput) {
    console.log("Unable to guess the number.");
    guessedNumber = Math.floor(Math.random() * 10) + 1;
    console.log(guessedNumber);
}