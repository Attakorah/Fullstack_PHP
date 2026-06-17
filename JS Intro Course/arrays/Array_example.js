let scores = [30,25,94,70,90,49,66];
var maxVal = -Number.MAX_VALUE;
var minVal = Number.MAX_VALUE;
var findVal;
var valueFound = false;
findVal = 67;

//Finding the maximum and minimum values in the array using a for loop.
for (let i = 0; i < scores.length; i++) {
    var item = scores[i];
    if (item > maxVal) {
        maxVal = item;
    }
    if (item < minVal) {
        minVal = item;
    }
}

//Finding a specific value in the array using a for loop.
for (let i = 0; i < scores.length; i++) {
    var item = scores[i];
    if (item === findVal) {
        valueFound = true;
        break;
    }
}

console.log("The maximum score is: " + maxVal);
console.log("The minimum score is: " + minVal);
console.log("The value " + findVal + " was found in the array: " + valueFound);