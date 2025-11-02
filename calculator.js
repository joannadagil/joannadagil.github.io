const display = document.getElementById('display');

function append(value) {
  let lastChar = display.value.slice(-1);

  // Handle operators
  if ('+-*/'.includes(value)) {
    if ('+-*/'.includes(lastChar) || display.value == '') {
      //return; // prevent consecutive or starting operators
    }
    display.value += value;
  } else if (value === '.') {
    let correct = true;
    let i = -1;

    while (Math.abs(i) <= display.value.length) {
      lastChar = display.value.slice(i, i + 1);
      if (lastChar == '.') {
        correct = false;
        break;
      }
      if ('+-*/'.includes(lastChar) || lastChar == '') {
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
    let expression = display.value;
    // Prevent eval crash if last char is operator
    if ('+-*/'.includes(expression.slice(-1))) {
      expression = expression.slice(0, -1);
    }
    display.value = eval(expression);
  } catch (error) {
    display.value = 'Error';
  }
}
