## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼

VARCHAR 可變長度 (0-65,535) 的字串，VARCHAR可以給預設值。
TEXT沒辦法給預設值，當不知道最大長度時，可以用TEXT。例如：文章。

## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？

Cookie：瀏覽器發送request給server，server叫瀏覽器設置cookie，瀏覽器把資料存在cookie裡，server利用set-code的語法，讓瀏覽器儲存內容發送request傳給server。


## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？

密碼存明碼，當駭客入侵資料庫後，全資料庫的會員資料就會被駭客知道，造成資料被竊取。
