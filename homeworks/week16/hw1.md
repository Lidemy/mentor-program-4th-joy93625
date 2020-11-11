```
console.log(1)
setTimeout(() => {
  console.log(2)
}, 0)
console.log(3)
setTimeout(() => {
  console.log(4)
}, 0)
console.log(5)
```
答案：
1 => 3 => 5 => 2 => 4



JavaScript是一種單執行緒的程式語言，RunTime一次只能做一件事，JavaScript RunTime一次只能做一件事，函數調用時需要花費大量時間處理，會發生blocking(阻塞)，瀏覽器會提供額外的東西，叫做Web API，來幫忙處理一些事項，完成後回傳到另一個地方，就叫做 佇列(task queue)

call stack 是一種資料結構，能夠記錄我們在程式中的哪個位置，並依序堆疊上去。  
Event Loop(事件循環)：主要工作就是查看stack並查看task queue讓stack能有效地執行。  

運作順序：  
1. console.log(1)  => Call Stack 先記錄  
2. `setTimeout(() => {
  console.log(2)
}, 0) `  
=> 調用時 Web API幫忙處理執行後，處理完後放置task queue  
3. console.log(3) => Call Stack 先記錄  
4. `setTimeout(() => {
  console.log(4)
}, 0) `  
=> 調用時 Web API幫忙處理執行後，處理完後放置task queue  
5. onsole.log(5) => Call Stack 先記錄  
6.  Event Loop啟動 => 把 2. 回調至 call Stack  
7.  Event Loop啟動 => 把 4. 回調至 call Stack  
