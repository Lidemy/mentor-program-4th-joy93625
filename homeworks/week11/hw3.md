## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫

雜湊函數

是一個單向的函數，最有名的叫做md5

MD5是一種網絡加密技術  
md5(1)=dshflsadhfl  
md5(11)=kjpojqwnklflj

把無限的輸入對應到有限的輸出，因為可能有兩個不同的輸入卻是相同的輸出，因此無法逆推，但也會產生碰撞，這就是為什麼「忘記密碼」只能重設，沒辦法告訴你原本的密碼。

暴力破解
記住md5(1)=dshflsadhfl、md5(11)=kjpojqwnklflj，以此類推，找出加密亂碼後對應到md5(1)的亂碼破解

加鹽(salting)

自動幫使用者產生一段亂數，例如r3joi2，做md5的時候是對(r3joi2+密碼)，確保不會太輕易被破解。

SHA256

比md5更安全的雜湊函數，但越安全，速度也越慢，所以「忘記密碼」之後，能夠既密碼給你的網站，就是存了你的明碼。

## `include`、`require`、`include_once`、`require_once` 的差別

Require : 這個函式通常放在 PHP 程式的最前面，PHP 程式在執行前，就會先讀入 require 所指定引入的檔案，使它變成 PHP 程式網頁的一部份。常用的函式，亦可以這個方法將它引入網頁中。引入是無條件的，發生在程式執行前，不管條件是否成立都要匯入（可能不執行）。

include_once()函式：require_once() 函式會先檢查目標檔案的內容是不是在之前就已經匯入過了，如果是的話，便不會再次重複匯入同樣的內容。

Include: 這個函式一般是放在流程控制的處理區段中。PHP 程式網頁在讀到 include 的檔案時，才將它讀進來。這種方式，可以把程式執行時的流程簡單化。引入是有條件的，發生在程式執行時，只有條件成立時才匯入（可以簡化編譯生成的程式碼）。

include_once()：函式的作用和 include() 是幾乎相同的。
唯一的差別在於 include_once() 函式會先檢查要匯入的檔案是不是已經在該程式中的其它地方被匯入過了，如果有的話就不會再次重複匯入該檔案（這項功能有時候是很重要的，比方說要匯入的檔案裡面宣告了一些你自行定義好的函式，那麼如果在同一個程式重複匯入這個檔案，在第二次匯入的時候便會發生錯誤訊息，因為 PHP 不允許相同名稱的函式被重複宣告第二次）。
執行時報錯方式不同。

include和require的區別：include引入檔案的時候，如果碰到錯誤，會給出提示，並繼續執行下邊的程式碼，require引入檔案的時候，如果碰到錯誤，會給出提示，並停止執行下邊的程式碼。

## 請說明 SQL Injection 的攻擊原理以及防範方法

SQL Injection

設計不良的程式會讓輸入變成程式的一部分，攻擊者就可以構造出特殊的文字變成程式。

select * from users **where username=''or 1=1** (--' and password='123')括號後被註解掉

帳號填入：'or1=1––是註解的意思，在後面的都會被省略or1=1保證是true，所以一定會找到資料。

預防攻擊方法：

防止刻意人士利用 奇怪語法連結到不同網站，或是其他不好的操作，可以在 php 程式碼中，把 sql 語句加入到 prepare( ) ;

php內建-Prepared Statements  
https://www.php.net/manual/en/mysqli.quickstart.prepared-statements.php

$sql = "INSERT INTO comments(nickname, content) values(?, ?)";  
$stmt = $conn->prepare($sql);  
$stmt->bind_param('ss', $nickname, $content);  
$result = $stmt->execute();  
  if (!$result) {  
     die($conn->error);  
        }  
$result = $stmt->get_result();  

### 1.先把sql insert into 後的values裡的值改成？  
### 2.設一個 $stmt  
### 3.$stmt = $conn−>prepare(conn−>prepare($sql);  
### 4.$stmt = bind_param(‘ss’, $nickname, $content); (‘ss’ 代表兩個字串)  
	
	bind_param()函式用法  
	該函式繫結了 SQL 的引數，且告訴資料庫引數的值。 “sss” 引數列處理其餘引數的資料型別。s 字元告訴資料庫該引數為字串。
	引數有以下四種型別:  
	i – integer（整型）  
	d – double（雙精度浮點型）  
	s – string（字串）  
	b – BLOB（布林值）  
	每個引數都需要指定型別。  
	通過告訴資料庫引數的資料型別，可以降低 SQL 注入的風險。

### 5.$stmt->execute(); 執行  
### 6.$stmt->get_result();  (才會真的把結果拿回來)


##  請說明 XSS 的攻擊原理以及防範方法

一樣是讓輸入變成程式的一部分，例如說我網站的姓名取叫：< h2 > hi < h2 >，就會被解析成html，而不是純文字。
SQL、XSS 這兩種攻擊方式，都是因為沒有處理好「使用者的輸入」，而造成非預期的程式執行。

解決辦法：過濾輸入特殊文字  
### XSS與修正問題：htmlspecialchars

php內建-htmlspecialchars  
https://www.php.net/manual/en/function.htmlspecialchars.php

在utils.php新增一個function  
>     function escape($str) {  
>         return htmlspecialchars($str, ENT_QUOTES);  
>     }  

再去到index.php，可以輸入資訊的地方都加上，escape()這個function。

例如留言欄位、暱稱、帳號

 `<p class="card_body-content"><?php echo escape($row['content']); ?></p>`

## 請說明 CSRF 的攻擊原理以及防範方法

CSRF 是一種 Web 上的攻擊手法，全稱是 Cross Site Request Forgery，跨站請求偽造。CSRF 就是在不同的 domain 底下卻能夠偽造出「使用者本人發出的 request」。


Server 的防禦  
1. 檢查 Referer  
2. 加上圖形驗證碼、簡訊驗證碼等等  
3. 加上CSRF token  
4. Double Submit Cookie  

browser 本身的防禦
Google 在 Chrome 51 版的時候正式加入了這個功能：SameSite cookie

資料來源：[讓我們來談談 CSRF](https://blog.techbridge.cc/2017/02/25/csrf-introduction/)