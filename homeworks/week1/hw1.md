## 交作業流程

## Command line指令


1. $ mkdir lidemy
2. $ cd lidemy
3. $ git clone https://github.com/Lidemy/mentor-program-4th-joy93625.git
4. $ ls
5. $ cd mentor-program-4th-joy93625
6. $ open .

> 先設一個lidemy資料夾，切換到lidemy資料夾，clone mentor-program-4th-joy93625到我的電腦裡，查看資料夾清單，切換到mentor-program-4th-joy93625，然後打開。

**完成hm1並存擋後**

7. $ git status
8. $ git branch week1
9. $ git checkout week1
10. $ git status
11. $ git commit -am "week1完成"
12. $ git status

> 先查看git是否有更新hm1內容，設一個新的branch為week1，切換到branch week1，查看更新內容的檔案，commit一個 "week1完成"，再次檢查狀態。

13. $ git push orgin week1
14. 打開github的Pull requests
15. 右邊compare & pull requests綠色按鈕
16. title: week1完成 並提交

> push 把local的branch推到遠端，把week1的branch merge到master。

17. 到lidemylearning作業列表
18. 把pull request的連結貼上並提交作業

**等批改完作業merge完後，查看是否已經merge**

19. $ git checkout master
20. $ git pull origin master
21. $ git branch -d week1
22. $ git branch -v
23. $ git log

> 先切換到master，把遠端的master與local端同步，刪除week1的branch，檢查剩下branch是否刪除week1的branch，log查看歷史紀錄是否 Merge pull request。