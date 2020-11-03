主要參考來源：[
[ 紀錄 ] 部屬 AWS EC2 雲端主機 + LAMP Server + phpMyAdmin](https://mtr04-note.coderbridge.io/2020/09/15/-%E7%B4%80%E9%8C%84-%08-%E9%83%A8%E5%B1%AC-aws-ec2-%E9%9B%B2%E7%AB%AF%E4%B8%BB%E6%A9%9F-/)

接下來的步驟都跟著同學的筆記一起操作到連線都沒遇到什麼困難成功連線，打開終端機CLI的指令設定

### 設定 LAMP
更新 ubuntu 的系統
安裝 Tasksel
用 Tasksel 下載 lamp-server
### 設定 phpmyadmin
下載 phpmyadmin
設置密碼
設定 root 的密碼
### 測試檔案
新增一個index.php
內容測試
```
<?php
    echo 'hello word!';
?>
```
發現權限不夠，也有修改權限
在瀏覽器上輸入
http://3.135.202.181/index.php
成功看到剛剛輸入的 hello world!

### 遇到的困難

想試著從Sequel Pro進入但是一直卡住，有到

`vim /etc/mysql/mysql.conf.d/mysqld.cnf`

有註解到這行，但還是沒用
```
bind-address     = 127.0.0.1
```

打開瀏覽器到phpmyadmin裡編輯權限把localhost改成 ％
還是沒辦法更新
最後更改了phpmyadmin密碼後
又出現了新的錯誤
`ERROR 1819 (HY000) Your password does not satisfy the current policy requirements`

上網查了一下，似乎是不符合MySQL密碼規範

以root用戶登入MySQL

`$ mysql -u root -p`

MySQL 8.0 調整密碼驗證規則：
```
mysql> set global validate_password.policy=0;
mysql>  set global validate_password.length=1;
```

之後再從新到瀏覽器phpmyadmin編輯權限成功把localhost改成 ％
再次登入Sequel Pro就成功登入了。

結論是不知道原因出在哪裡，應該只是密碼打錯進不去，但懂的利用關鍵字去找出錯誤在哪， 所以其實過程中也沒有卡得太久！