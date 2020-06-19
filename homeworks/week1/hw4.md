## 跟你朋友介紹 Git

## 什麼是 Git?
### git就是幫你做版本控制
> 版本控制：   
> 笑話＿修.txt   
> 笑話＿更新.txt  
> 笑話＿最新複製.txt  
> 笑話.txt   
> 笑話＿最終版.txt    
> 笑話＿最終更新.txt   

**使用Git版本控制系統**

Git為**分散式**版本控制系統，Git可以更新歷史記錄保存起來。因此編輯過的檔案復原到以前的狀態，也可以顯示編輯過內容的差異。

組群共享的檔案，如果有兩個人同時進行編輯，互相編輯到同一個檔案時，系統會發出警告，因此可以避免在無意中覆蓋他人的編輯內容。

---

## git
### 環境設置
1. 安裝
2. 設定使用者  

`$ git config --global user.name "使用者名稱"`
`$ git config --global user.email 你的信箱@example.com`

### 以步驟方式說明基本git相關指令
 **會以command line來操作git指令**
 
### ` Step.1` 新增一個資料夾
 * `$ mkdir git_test` 新增一個資料夾git_test
 
### ` Step.2` 資料夾初始化
* `$ git init` 讓git開始對這資料夾進行本版控制  

>  進行版本控制後，git會在資料夾裡新增隱藏 .git的資料夾，裡包含了系統擋。

* `$ rm -r .git` 取消版本控制
* `$ git rm --cached <file>` 這個檔案不加入版本控制

### ` Step.3` 查看狀態
* `$ git status` 檢查當前版本狀態

>Changes to be committed（將要提交的檔案）  
>Changes not staged for commit（被更動但尚未要提交的檔案）  
>Untracked files（未被追蹤的檔案）

### ` Step.4` 新增兩個檔案
* `$ echo "helle world" > first.html` 
* `$ echo '123' > 123.txt` 

### ` Step.5` 決定哪些檔案加入版本控制
* `$ git add first.html` 將first.html這檔案加入版本控制
* `$ git add .` 把所以檔案加入版本控制
* `$ git status` 再次查看狀態檔案是否有加入版本控制

### ` Step.6` 新建一個commit
* `$ git commit -am 'first commit'` 

> 這動作後就是成功的把在暫存區(Staging Area)的東西放到儲存庫(repo)裡。  
> 把commit想像是建一個新資料夾，把更新的檔案版本放入在first commit的資料夾裡

 補充：          
 ` $ git commit -m <file>` commit一個版本控制
 `$ git commit -am <file>` 可是快速commit，省略 `$ git add <file>`，但此指令對新加入的檔案無效。
 
### ` Step.7` 檢視commit紀錄
* `$ git log` 越新的commit會在越上面
* `$ git log --oneline` 輸出更簡潔的log
* 按	q離開
### ` Step.8` 切換版本
* `$ git checkout <版本名稱ad9d73dbfe0b0.....>` 可以回到想到的版本
* `$ git checkout master` 回到最新狀態

### ` Step.9` 新增忽略的檔案
* `$ touch .gitignore` 新增一個 .gitignore的檔案
* `$ vim .gitignore` vim編輯裡輸入需要忽略的檔名，存擋離開 :wq
* `$ cat .gitignore` 查看忽略的檔案  

> 在`$ git add .` 全部commit，.gitignore也是需要一起加入，因為也要讓其他人知道忽略了什麼檔案，通常大多是一些簡介不需要一直更新的檔案會放入.gitignore裡。

### ` Step.10` 看改了什麼
* `$ git diff` 

> 在執行 git diff commit1 commit2 指令，比對兩個版本間的差異，其中 commit1 請用較舊的版本，而 commit2 則用較新的版本


###  其他補充
* `$ git commit --amend` 修改commit 的名稱 
* `$ git reset <85e7e30>`把目前的狀態退回到哪個 Commit
* `$ git reset HEAD^ --hard` 刪掉最新的commit(包含改過的檔案)
* `$ git reset HEAD^ --soft`  (預設就是不用加 --soft)只是不commit更改的檔案，Commit 拆出來的檔案會直接放在暫存區。

---

## Git進階使用分支(branch)與合併(merge)
**打開終端機（Terminal）到有進行版控的資料夾後，可以發現有寫 master ，這是 Git 幫你建立的第一個分支。**

> 分支可以多人在同一個專案裡，建立不同分支各自開發不同區域，之後合併在同個專案裡。

### `$ branch -v` 查看有哪些branch
### `$ branch iss01` 建立一個iss01分支
### `$ git checkout iss01` 切換到iss01分支
### `$ merge iss01` 把iss01分支合併到master
> 合併之前，必須先`$ git checkout master` 才能把iss01分支合併到master合併

### `$ branch -d iss01` 刪除iss01分支
> 因為已經與master合併後，就能把iss01的分支刪除

## 處理衝突
**衝突就是合併後修改到同一個檔案，但是git會不知道需要留下哪個版本，所以必須 [手動]進行修改**

* 假設 first.html 發生衝突
* 合併後，git會告訴你 first.html 需要手動進行修改
* 修改完成後
* `$ git add first.html` 把檔案加入暫存區
*  `$ git commit -m ‘修改衝突完成‘`

## 工程師之間的協作：GitHub Flow

### Github 
是一個支援 git 程式碼存取和遠端托管的平台服務，有許多的開放原始碼的專案都是使用 Github 進行程式碼的管理。

1. `$ git clone <clone的網址>` 把github專案clone下來
2. `$ git push origin master` 把主機資料 push到github上
3. 假設遠端已經有另個工程師進行改變
4. `$ git pull origin master` 把遠端新的更變pull到local端

> 如果遠端資料更新，先pull到主機，更改或新增自己的檔案後再push到遠端。
