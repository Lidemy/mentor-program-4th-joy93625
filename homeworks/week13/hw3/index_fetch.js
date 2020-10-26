    const API_URL = 'https://api.twitch.tv/kraken';
    const CLIENT_ID = 's44s145uexjgeu9mqqa1s93oc1bnli';
    const ACCEPT = 'application/vnd.twitchtv.v5+json';
    const STREAM_TEMPLATE = `
      <div class="card" style="width: 20rem;">
        <a href = "$url">
        <img src="$preview" class="card-img-top">
        <div class="card-body">
          <p class="card-text">$status</p>
        </div>
      </div>
    `


    getGames(function (games) {
      for (let game of games) {
      let element = document.createElement('li')
      document.querySelector('.navbar-nav').appendChild(element)
      element.outerHTML = `
        <li class="nav-item">
          <a class="nav-link" href="#">${game.game.name}<span class="sr-only"></span></a>
        </li>
        `
      }
      // 顯示第一個遊戲實況名稱
      changeGame(games[0].game.name)

    }); 

    document.querySelector('.navbar-nav').addEventListener('click', e => {
      if (e.target.tagName.toLowerCase() === 'a') {
        const gameName = e.target.innerText;
        changeGame(gameName)
      }
    })

    function changeGame(gameName) {
      document.querySelector('h1').innerText = gameName;
      document.querySelector('.cards').innerHTML = ''
      getStreams(gameName, function(streams){
        for(let stream of streams) {
              appendStream(stream)
            }
      })
    }

    function appendStream(stream) {
      let element = document.createElement('div')
      document.querySelector('.cards').appendChild(element)
      element.outerHTML = STREAM_TEMPLATE
        .replace('$url', stream.channel.url)
        .replace('$preview', stream.preview.large)
        .replace('status', stream.channel.status)
    }

    function getGames(callback) {
        fetch(`${API_URL}/games/top?limit=5`, {
            method: 'GET',
            headers: new Headers({
                'Client-ID': CLIENT_ID,
                'Accept': ACCEPT
            })
        }).then(response => {
                return response.json()
        })
        .then(games => callback(games.top))
        .catch(err => console.log(err))
    }

    function getStreams(gameName, callback) {
        fetch(`${API_URL}/streams?game=${encodeURIComponent(gameName)}`, {
            method: 'GET',
            headers: new Headers({
                'Client-ID': CLIENT_ID,
                'Accept': ACCEPT
            })
        }).then(response => {
            return response.json()
        })
        .then(data => {
            callback(data.streams)
        })
        
    }
