let gender = 'female';
let isAfrican = 'true';

if (gender === 'female' && isAfrican === 'true') {
    console.log('100% Scholarship');
} else if (gender === 'female' || isAfrican === 'true') {
    console.log('80% Scholarship');
} else {
    console.log('50% Scholarship');
}