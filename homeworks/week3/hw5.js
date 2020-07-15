const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

function bigger(arr) {
  if (Number(arr[0]) === Number(arr[1])) {
    console.log('DRAW');
  } else if (Number(arr[0]) > Number(arr[1])) {
    console.log('A');
  } else {
    console.log('B');
  }
}

function smaller(arr) {
  if (Number(arr[0]) === Number(arr[1])) {
    console.log('DRAW');
  } else if (Number(arr[0]) > Number(arr[1])) {
    console.log('B');
  } else {
    console.log('A');
  }
}

function solve(input) {
  const m = Number(input[0]);
  for (let i = 1; i <= m; i += 1) {
    const arr = input[i].split(' ');
    if (Number(arr[2]) === 1) {
      bigger(arr);
    } else {
      smaller(arr);
    }
  }
}

rl.on('close', () => {
  solve(lines);
});
