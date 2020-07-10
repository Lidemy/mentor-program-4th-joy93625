const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
});

const lines = [];

// 讀取到一行，先把這一行加進去 lines 陣列，最後再一起處理
rl.on('line', (line) => {
  lines.push(line);
});

function digitsCount(n) {
  if (n === 0) return 1;
  let result = 0;
  let num = n;
  while (num !== 0) {
    num = Math.floor(num / 10);
    result += 1;
  }
  return result;
}

function isNarcissistic(n) {
  let m = n;
  const digits = digitsCount(m);
  let sum = 0;
  while (m !== 0) {
    const num = m % 10;
    sum += num ** digits;
    m = Math.floor(m / 10);
  }
  if (sum === n) {
    return true;
  }
  return false;
}

// 上面都不用管，只需要完成這個 function 就好，可以透過 lines[i] 拿取內容

function solve(input) {
  const temp = input[0].split(' ');
  const n = Number(temp[0]);
  const m = Number(temp[1]);
  for (let i = n; i <= m; i += 1) {
    if (isNarcissistic(i)) {
      console.log(i);
    }
  }
}

// 輸入結束，開始針對 lines 做處理
rl.on('close', () => {
  solve(lines);
});
