const display = document.getElementById('display');

function append(value) {

  let lastChar = display.value.slice(-1);

  if ('+-*/'.includes(value)) {
    if ('+-*/'.includes(lastChar) || lastChar === '') {
      // Do nothing
    } else {
      display.value += value;
    }
  } else if (value === '.') {
    let correct = true;
    let i = -1;

    while (Math.abs(i) <= display.value.length) {
      lastChar = display.value.slice(i, i + 1);
      if (lastChar === '.') {
        correct = false;
        break;
      }
      if ('+-*/'.includes(lastChar) || lastChar === '') {
        break;
      }
      i--;
    }
    if (correct) {
      display.value += value;
    }
  } else {
    display.value += value;
  }
}
function C() {
  display.value = '';
}
function res() {
  try {
    let expression = eval(display.value);
    display.value = expression;
  } catch (error) {
    display.value = 'Error';
  }
}