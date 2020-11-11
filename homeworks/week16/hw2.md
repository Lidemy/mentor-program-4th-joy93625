```javascript
for(var i=0; i<5; i++) {
  console.log('i: ' + i)
  setTimeout(() => {
    console.log(i)
  }, i * 1000)
}
```

call stack:  
js  
console.log(0)  
console.log(1)  
console.log(2)  
console.log(3)  
console.log(4)  

for迴圈 i=5，跳出迴圈

WebAPIS:  
Web API幫忙處理執行( 0 * 1000 )後，處理完後放置task queue   
Web API幫忙處理執行( 1 * 1000 )後，處理完後放置task queue   
Web API幫忙處理執行( 2 * 1000 )後，處理完後放置task queue   
Web API幫忙處理執行( 3 * 1000 )後，處理完後放置task queue   
Web API幫忙處理執行( 4 * 1000 )後，處理完後放置task queue   

event loop啟動  
此時i=5，每隔一秒，印出5

答案：  
i: 0  
i: 1  
i: 2  
i: 3  
i: 4  
5  (隔一秒)  
5  (隔一秒)  
5  (隔一秒)  
5  (隔一秒)  
5  

