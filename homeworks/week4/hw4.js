const request = require('request');

const CLIENT_ID = 'mpwx9xk5eba70v0m1cy32p6q6lej0b';
const BASE_URL = 'https://api.twitch.tv/kraken/games/top';

const options = {
  url: `${BASE_URL}`,
  headers: {
    'Client-ID': CLIENT_ID,
    Accept: 'application/vnd.twitchtv.v5+json',
  },
};

function callback(err, res, body) {
  if (err) {
    console.log(err);
    return;
  }

  const data = JSON.parse(body);
  for (let i = 0; i < data.top.length; i += 1) {
    console.log(`${data.top[i].viewers} ${data.top[i].game.name}`);
  }
}

request(options, callback);
