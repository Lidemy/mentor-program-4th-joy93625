const request = require('request');

const args = process.argv;
const API_ENDPOINT = 'https://restcountries.eu/rest/v2/name';

const name = args[2];

const nameInput = function () {
  if (!name) {
    console.log('請輸入國家名稱');
  }
};

request(`${API_ENDPOINT}/${name}`, (error, res, body) => {
  let data;

  try {
    data = JSON.parse(body);
    if (nameInput > 0) return;
    if (res.statusCode >= 200 && res.statusCode < 300) {
      for (let i = 0; i < data.length; i += 1) {
        console.log('============');
        console.log('國家：', data[i].name);
        console.log('首都：', data[i].capital);
        console.log('貨幣：', data[i].currencies[0].code);
        console.log('國碼：', data[i].callingCodes[0]);
      }
    } else if (res.statusCode === 404) {
      console.log('找不到國家資訊');
    }
  } catch (err) {
    console.log('抓取失敗', err);
  }
});
