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

## 更新于2026年2月12号
最近我自己也写了一个社区网站，用来自助下单上量的商品的
刚开始做抖音时，我的互动率非常低，点赞和评论都不尽人意，直到我使用了刷粉自助下单。通过这个平台，我能够精准投放流量给活跃的抖音用户。互动量、评论和点赞数迅速提升，我的抖音内容开始得到更多观众的喜爱，曝光度也大大提高。 一键下单，精准流量带来了我想要的抖音曝光，效果堪比我多个月的努力！ 网址：**http://www.qxsq.top** 如果站点无法进入表示网络不稳定，开启VPN即可进入24小时自助下单平台源头（用浏览器打开）。 招代理，搭建同款站点，一键躺赚，招机房供货商。 
telegram飞机电报联系: @qixingshequ
telegram飞机通知群：https://t.me/qixingshequ0
QQ: 1365038232


