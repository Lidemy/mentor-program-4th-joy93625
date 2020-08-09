## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。

`<strike></strike> `:(刪除線)

`<marquee> </marquee>`:走馬燈

`<select></select>`:選單、清單

通常都是搭配`<option>`一起使用

## 請問什麼是盒模型（box modal）

CSS box model 盒子模型也稱為區塊模型，假設我們用了一個 DIV 區塊來放置內容，CSS 允許網頁設計師將 DIV 區塊看成一個盒子，透過控制內距的 padding、控制外距的 margin 以及控制元素邊框的 border 屬性來調整盒子的展現結果。

## 請問 display: inline, block 跟 inline-block 的差別是什麼？

### Inline行內元素
* 元素可在同一行內呈現，圖片或文字均不換行，也不會影響其版面配置
* 不可設定長寬，元素的寬高由它的內容撐開

雖有設定padding及margin，但元素上下並不會把其他行推開，但若設定框線或背景顏色就會發現事實上會使得其他行被蓋到。

### Block區塊元素
* 元素寬度預設會撐到最大，使其占滿整個容器
* 可以設定長寬/margin/padding，但仍會占滿一整行高/padding/margin，但其屬性仍會向右占滿容器，下個元素就會換行來呈現，並不會並排。

### inline-block行內區塊
* 以inline的方式呈現，但同時擁有block的屬性
* 可設定元素的寬高/margin/padding
* 可水平排列

display:inline-block 後，即可同時擁有block可設定寬高的屬性，但其排版仍像inline屬性，並不會向右占滿整個容器。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？

### Static 無定位
預設定位，會照著瀏覽器預設的配置自動排版，無法定義 top、left、bottom 與 right 的數值。
### Relative 相對定位
Relative 在沒有設定任何屬性的情況下，會和Static的呈現方式一樣。  
但他和 Static 不同的地方就在於，他可以透過 top、left、bottom 與 right 的數值來改變他的位置，但無論它在頁面上移動了多少位置，都不會影響其他元素的位置。
### Absolute 絕對定位
Absolute是一個非常特殊的屬性，他和Fixed屬性相似，不一樣的地方在於他的基準點會以屬性是Relative的父層為基準，所以如果他沒有Relative父層的情況下，他會直接找到body（黃框）並以他為基準點。
### Fixed 可視區絕對定位
Fixed的元素會以瀏覽器視窗（可視範圍）來定位，意味著即便頁面滾動，他還是會固定在相同位置。  
Fixed 屬性很特別的的地方是不會像 Relative 一樣會在原圖層留下他的空間，若後面還有Relative屬性的元素，則會黏在前面同是Relative或是Static屬性的元素下方。
### Sticky 滾動黏滯定位
Sticky英文字面上意思是黏、黏貼，這個元素結合了兩種屬性，分別為Relative以及fixed，非常適用於某些特殊地方。  
> ＊重要--此元素一定要在 top、left、bottom或right 中指定一個屬性，黏性定位才會生效！否則行為就和Relative屬性一樣。  
＊重要--此元素在沒有跨越特定範圍時為Relative屬性，超出後則會為Fixed屬性，也就是文件若是出現scroll-bar時，他就會由Relative屬性轉換為Fixed屬性。