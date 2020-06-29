``` js
function isValid(arr) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] <= 0) return 'invalid'
  }
  for(var i=2; i<arr.length; i++) {
    if (arr[i] !== arr[i-1] + arr[i-2]) return 'invalid'
  }
  return 'valid'
}

isValid([3, 5, 8, 13, 22, 35])
```

## 執行流程
1. 呼叫 isValid 這個function，arr參數帶入 [3, 5, 8, 13, 22, 35]
2. 執行for 迴圈 ，宣告變數 i 為 0，判斷 i 是否小於 arr.length(6)，是的話執行迴圈，
3. 執行第 3 行，判斷 arr[0] (3) 是否小於或等於 0，否，不執行 if block
4. 回到第 2 行，執行 i++，i = 1，判斷 i 是否小於 arr.length(6)，是，繼續執行迴圈
5. 執行第 3 行，判斷 arr[1] (5) 是否小於或等於 0，否，不執行 if block
6. 回到第 2 行，執行 i++，i = 2，判斷 i 是否小於 arr.length(6)，是，繼續執行迴圈
7. 執行第 3 行，判斷 arr[2] (8) 是否小於或等於 0，否，不執行 if block
8. 回到第 2 行，執行 i++，i = 3，判斷 i 是否小於 arr.length(6)，是，繼續執行迴圈
9. 執行第 3 行，判斷 arr[3] (13) 是否小於或等於 0，否，不執行 if block
10. 回到第 2 行，執行 i++，i = 4，判斷 i 是否小於 arr.length(6)，是，繼續執行迴圈
11.  執行第 3 行，判斷 arr[4] (22) 是否小於或等於 0，否，不執行 if block
12.  回到第 2 行，執行 i++，i = 5，判斷 i 是否小於 arr.length(6)，是，繼續執行迴圈
13.  執行第 3 行，判斷 arr[5] (35) 是否小於或等於 0，否，不執行 if block
10. 回到第 2 行，執行 i++，i = 6，判斷 i 是否小於 arr.length(6)，否，結束迴圈
 **第一個for迴圈，是判斷arr陣列裡是否為正數。**
11. 執行第二個for迴圈，宣告變數 i 為 0，判斷 i 是否小於 arr.length(6)，是的話執行迴圈，
12. 執行第5行，如果 arr[2] (8)，判斷 不等於 arr[2-1](5)， + arr[2-2] (3)， 8 !== 5+3，不是，跑回第二個for迴圈第一行，執行i++
13.  執行第5行，如果 arr[3] (13)，判斷 不等於 arr[3-1](8)， + arr[3-2](5)，13 !== 8+5，不是，跑回第二個for迴圈第一行，執行i++
14.  執行第5行，如果 arr[4] (33)，判斷 不等於 arr[4-1](13)， + arr[4-2](8)，22 !== 13+8，是！！！，回傳 'invalid'，結束這個function。


