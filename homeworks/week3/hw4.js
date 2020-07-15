const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function solve(input) {
  const str = input[0];

  function reverse(strs) {
    let result = '';
    for (let i = strs.length - 1; i >= 0; i -= 1) {
      result += strs[i];
    }
    return result;
  }
  if (reverse(str) === str) {
    console.log('True');
  } else {
    console.log('False');
  }
}

rl.on('close', () => {
  solve(lines);
});
