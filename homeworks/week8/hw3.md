## 什麼是 Ajax？

要在瀏覽器上面發送Request，必須應用到一種技術叫「Ajax」(Asynchronous JavaScript and XML)，重點就在於 Asynchronous，非同步。  
非同步: 執行完之後就不管，不等結果是否回來，繼續執行。  
非同步的Function不能直接透過return把結果傳回來，當非同步的操作完成時，就可以呼叫CallBack Function (回呼涵式)，把資料帶進來，Ajax運用非同步的特性，來處理從Server回傳的資料，網頁不用換頁，就可以及時更新部分畫面，提升網頁的互動跟速度。

## 用 Ajax 與我們用表單送出資料的差別在哪？

### 表單：
是以html的form元素來傳送資料，當送出表單時就向網頁伺服器傳送一個請求，伺服器接收並處理傳來的表單，然後送回一個新的網頁，由於每次應用的溝通都需要向伺服器傳送請求，導致了使用者介面的回應比本機應用慢得多。  
### Ajax：
由於Ajax「非同步」特性，當從Serve拿到回傳的資料，無需換頁，部份畫面也可以及時調整和改變。

## JSONP 是什麼？

JSONP全名JSON with Padding，跨來源請求，除了CORS以外，另一種就是JOSNP，利用 <script>的src屬性不受「同源政策」的控制，「作弊」般地巧妙地逃過了瀏覽器的這一限制。src屬性的不止有<script>,還有<img>和<iframe>。
缺點就是要帶的那些參數永遠都只能附加在網址上的方式(GET)帶過去，無法使用POST。
如果能用CORS的話，還是應該優先考慮CORS

## 要如何存取跨網域的 API？

瀏覽器因為安全性的考量，有個叫「同源政策」(Same-origin policy)，如果網站跟需要呼叫的API網站「不同源」，瀏覽器一樣會發Request，但會把Response給擋下來，不讓JavaScript拿到並回傳錯誤。只要Domain不同就是不同源，或是一個用http一個用https也是不同源，所以如果接別人的API，大多數都是不同源的。
在不同的origin之間傳輸資料，規範就叫「CORS」(Cross-Origin Resource Sharing)-跨來源資料共享
如果要開啟跨來源HTTP請求的話，Serve必須在Response的Header裡面加上 Access-Control-Allow-Origin: * (星號代表萬用字元)，檢驗通過，允許接受跨來源請求的回應。

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？

第八週主要透過瀏覽器與Serve進行資料交換，瀏覽器「同源政策」的限制，所以必須遵守相關規則獲取資料，第四週是透過Node.js是直接與Serve進行交換資料，中間不會受到任何限制。
