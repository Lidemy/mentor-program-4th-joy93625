## 請以自己的話解釋 API 是什麼

API(Application Programming Interface),中文翻譯：「應用程式介面」。

是一個能讓雙方所需要的資訊交流的介面，例如怎樣能在我的網站上用Google的登入功能，以 Google 登入 API 來說，因為「我想在我的網站上使用 Google 登入」，而 Google 「開放」出這個 API 是因為「Google 想讓其他網站都可以用 Google 帳號登入」。


[Huli-從拉麵店的販賣機理解什麼是 API](https://medium.com/@hulitw/ramen-and-api-6238437dc544)

## 請找出三個課程沒教的 HTTP status code 並簡單介紹

**410 - 過時網頁**.  
410比404保存得更久，這代表著該網頁已經消失。 該頁面不再可用，並且沒有設定轉址。

**423 - Locked**.  
正在訪問的資源被鎖定。

**511 - Network Authentication Required**.  
511狀態碼表示客戶端需要進行身份驗證才能獲得網絡訪問權限。


## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

| 說明     | Method | path       | 參數                   | 範例             |
|--------|--------|------------|----------------------|----------------|
| 獲取所有餐廳 | GET | /restaurants | 限制回傳資料數量 | /restaurants?_limit=5 |
| 獲取單一特定餐廳 | GET | /restaurants/:id | 無 | /books/10 |
| 新增餐廳 | POST | /restaurants | name: 餐廳名稱 | 無 |
| 刪除餐廳 | DELETE | /restaurants/:id | 無 | 無 |
| 更改餐廳資訊 | PATCH | /restaurants/:id | name: 餐廳名稱 | 無 |