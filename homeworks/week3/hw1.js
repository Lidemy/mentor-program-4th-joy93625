const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function solve(input) {
  let result = '';
  for (let i = 1; i <= input[0]; i += 1) {
    result += '*';
    console.log(result);
  }
}

rl.on('close', () => {
  solve(lines);
});
