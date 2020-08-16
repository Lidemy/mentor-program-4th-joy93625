## 什麼是 DOM？
文件物件模型（Document Object Model, DOM）是一個以樹狀結構來表示 HTML 文件的模型，組合起來的樹狀圖，稱為「DOM Tree」。往下可以延伸出一個個的 HTML 標籤，一個節點就是一個標籤，往下又可以再延伸出「文本節點」與「屬性的節點」。
JavaScript就可以藉由DOM API去存取並改變HTML架構、樣式和內容的方法，JavaScript利用DOM這個橋樑在瀏覽器上做出許多有趣的互動。

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
1. 捕獲 (CapturePhase)
2. 點擊目標(TargetPhase)
3. 冒泡(BubblingPhase)

捕獲階段：由 DOM 樹的最外層依序向內，過程中觸發個別元素的捕獲階段事件監聽。  
冒泡階段：當事件傳達到 點擊目標 target 之後，再由內向外層傳回去，過程中觸發個別元素的冒泡階段事件監聽。

## 什麼是 event delegation，為什麼我們需要它？

Event delegation: 透過父節點來處理子節點的事件，就叫做事件代理(Event delegation)。  
有一個 ul，底下 1000 個 li，如果你幫每一個 li 都加上一個 eventListener，你就新建了 1000 個 function。所以將 click 事件綁在 ul上，藉由 Event Bubbling 傳遞給內層的 li，而非直接將事件綁定在 li 上，而這樣的好處是當新增或是刪除一個 li 的時候，不用去處理跟那個元素相關的 listener，因為listener 是放在 ul 身上。可減少監聽器的數目。

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
 **preventDefault:**
當點擊超連結的時候，就不會執行原本預設的行為（新開分頁或是跳轉），而是沒有任何事情發生，這就是preventDefault的作用。  
 **stopPropagation:**
你加在哪邊，事件的傳遞就斷在哪裡，不會繼續往下傳遞。不會再把事件傳遞給「下一個節點」，但若是你在同一個節點上有不只一個 listener，還是會被執行到。

 e.preventDefault與e.stopPropagation的差別在知道事件傳遞順序之後也大概能理解，前者就只是取消預設行為，跟事件傳遞沒有任何關係，後者則是讓事件不再往下傳遞。