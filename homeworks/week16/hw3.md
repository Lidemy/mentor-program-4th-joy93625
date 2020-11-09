```
var a = 1  
function fn() {  
  console.log(a) // 1.  
  var a = 5   
  console.log(a) // 2.   
  a++   
  var a
  fn2()
  console.log(a) // 4.
  function fn2(){
    console.log(a) // 3.
    a = 20
    b = 100
  }
}
fn()
console.log(a) // 5.
a = 10
console.log(a) // 6.
console.log(b) // 7.
```

## 步驟 1.
```
global vo: {
    a: undefined,
    fn: function
}
```
### 1. undefined

## 步驟 2.

因為fn()裡
var a = 5

```
fn vo: {
    a: 5,
    fn2: function
}
```
### 2. 5

## 步驟 3.  
此時的
var a = 5 
a++
a = 6

```
global vo: {
    a: 1,
    fn: function
}
fn vo: {
    a: 6,
    fn2: function
}
```
### 3. 6

## 步驟 4.  
執行fn2()
fn2內
因為沒有宣告變數，會自動宣告成global var ，因此改變 a、b 的值
```
fn vo: {
    a: 20
}
```
### 4. 20

## 步驟 5.  
執行fn()
只需要看 global var，與內部沒有關係

```
global vo: {
    a: 1,
    fn: function
}
```
### 5. 1

## 步驟 6.  
a = 10 已改變a的值

### 6. 10

## 步驟 7. 
``` 
global vo: {
    a: 1,
    fn: function,
    b: 100
}
```
### 7. 100

答案：  
undefined  
 5  
 6  
 20  
 1  
 10  
 100  