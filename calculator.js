const display = document.getElementById('display');

    function append(value) {
    
      let lastChar = display.value.slice(-1);

      if ('+-*/'.includes(value)) {
        if ('+-*/'.includes(lastChar)) {
            // Do nothing
        } else {
            let correct = true;
            let finished = false;
            let i = -1;
            while (!finished) {
                lastChar = display.value.slice(i, i+1);
                if (lastChar === '.') {
                    finished = true;
                    correct = false;
                }
            }
            if (correct) {
                display.value += value;
            }
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