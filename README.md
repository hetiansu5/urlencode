## URLEncode标准
* 在1994年订立的RFC1738中。
    * 对字符串中除了“-”、“_”、“.”之外的所有非字母数字字符都替换成百分号(%)后跟两位十六进制数。
    * 十六进制数中字母必须为大写。
```$
http://tools.ietf.org/html/rfc1738
```

* 在2005年定义的RFC3986中。
    * 将针对- _.~四个字符之外的所有非字母数字字符进行百分号编码。
    * 在Java和PHP当中，由于历史原因，导致在进行URLEncode的时候，会将空格编码为+，而不是编码为十六进制编码%20
```
http://tools.ietf.org/html/rfc3895
```

## PHP-URLEncode标准

### urlencode
* 实现的是1994年订立的RFC1738，另外特别对空格转义为+。
* 不做编码的字符：
```
-._0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz
```


### rawurlencode
* 实现的是2005年定义的RFC3986。
* 不做编码的字符：
```
-._~0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz
```


## JAVA-URLEncode标准
主要区别是*号的处理，PHP的编码为%2A，JAVA则保持*号不变。

## 使用示例
```
<?php

use UrlEncode\Java;

$res = Java::urlEncode("~ -+.*");
var_dump($res);
```