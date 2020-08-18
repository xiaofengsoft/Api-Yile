## XFS-小风 亿乐社区集成前台接口API



亿乐社区已经非常出名了,很多开发接口的phper需要接口维护

这款接口非常简单,但只适用于前台操作,适合对接亿乐社区的代刷网,发卡网等使用

### 安装

下载拖入项目

该类文件依赖 php-curl-class 的Curl包

可以在项目根目录使用命令 `composer require php-curl-class/php-curl-class` 安装此包

或者在GitHub里在线下载该包

https://github.com/php-curl-class/php-curl-class

即安装成功

### 使用

下载后在类中引用

`use XFS\Api\Yile` 

接着

`$Yile = new Yile('站点域名','用户编号','密钥');`

即可进行操作

例如查询所有商品,使用如下函数:

`$goodList = $Yile->getGoodList()`

即可

### XFS博客

http://xfs0.cn
