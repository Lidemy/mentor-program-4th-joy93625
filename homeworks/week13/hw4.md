## Webpack 是做什麼用的？可以不用它嗎？

 webpack 就是幫我們編譯我們的Preprocess成瀏覽器看得懂的內容然後打包成一包的完成檔案然後拿去server 上傳上去。  
 一般我們的專案會有兩個很重要的資料夾src與dist  
src : 專門放我們Preprocess的檔案，包括es6、pug、sass、vue、jsx等檔案，這個資料夾不會丟上去server部署。  
dist : 經過webpack編譯打包後，產生出瀏覽器看得懂的html、css、js，要部署也是這個資料夾去部署。  
通常會使用 webpack 的情境會是用在大型的應用程式專案，因為大型專案會需要面對眾多不同類型的檔案，所以在開發跟工作流程上，就需要強而有力的 webpack 來做模組相關的檔案處理；相對小型的專案，由於規模較小，可能就不太需要透過 webpack 的幫忙，讓管理專案的部分，可以較為輕巧、明確。

## gulp 跟 webpack 有什麼不一樣？

Gulp 為 Task Manager 管理各種功能任務，為自動化和優化前端工作流程，使用 Gulp 並搭配需要的功能 plugins，即可自動化你開發工作中機械重複任務（ ex. 壓縮、編譯、測試等等），以提升效率。Gulp 本身不包括模組化功能，且 Gulp 可支援的 Task 項目多於 Webpack。

Webpack 是 bundler，是前端資源（ ex. Javascript、SCSS、image ）模組化管理和打包工具。將所有資源視為模組，必須藉由各種資源的loader 處理轉換並打包。雖然 WebPack 可以處理類似 gulp 的文件壓縮合併、預處理等功能，但那些都只是 webpack 的附帶的功能，Webpack 重點為模組化開發。

## CSS Selector 權重的計算方式為何？

權重就是指 css 的優先權，例如:

1.相同權重但是後寫的 css 可以覆蓋先寫的 css
2.當兩個選擇器同時作用在一個元素，權重高的優先生效

###基本的權重大小
> inline style > ID > Class > Element > *

### Element
所有的 Element 的權重都是 0-0-0-1。
Element 總共有哪些呢？下面列出部分常見的

`div, p, ul, ol, li, em, header, footer, article....`

### class
class 在 html 上面會寫成 class="box" ，在 css 內長這樣 .box ，前方會有一個點'.'

每一個 class 的權重都是 0-0-1-0。

### id
id 在 html 上面是這樣寫的 id="home" ，在 css 內長這樣 #home ，前方會帶井字號。

每一個 id 的權重都是 0-1-0-0。

### inline style attribute
所謂的 inline style attribute 就是寫在 html 行內的 style

inline style attribute 的權重為 1-0-0-0 。

還有一個 !important

**!important 的權重非常高，可以蓋過所有的權重**

`!important > inline style > ID > Class/psuedo-class(偽類)/attribute（屬性選擇器） > Element`

參考來源：
[小事之 CSS 權重 (css specificity)](https://ithelp.ithome.com.tw/articles/10196454)