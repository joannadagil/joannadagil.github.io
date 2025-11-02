const display = document.getElementById('display');

function append_oper(value) {
  if (display.value == '') {
    if (value == '-') {
      display.value += value;
    } else { return; }
  }

  let lastChar = display.value.slice(-1);
  if (lastChar!='+' && lastChar!='-' && lastChar!='*' && lastChar!='/' && lastChar!='.') {        
    display.value += value;
  }
}

function append_dot() {
  let lastChar = display.value.slice(-1);
  if (lastChar=='+' || lastChar=='-' || lastChar=='*' || lastChar=='/' || lastChar == '' || lastChar == '.') {
    return;
  }

  let correct = true;
  let i = 1;

  while (i <= display.value.length) {
    lastChar = display.value.slice(-i, -i + 1);
    if (lastChar == '.') {
      correct = false;
      break;
    }
    if (lastChar=='+' || lastChar=='-' || lastChar=='*' || lastChar=='/' || lastChar == '') {
      break;
    }
    i++;
  }

  if (correct) {
    display.value += '.';
  }
}
function append(value) {
  display.value += value;
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
