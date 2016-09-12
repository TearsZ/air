<?php
/**
 * @FileName: template.tool.php
 * @Created by PhpStorm.
 * @Author: Titor <foolsecret@163.com>
 * @Datetime: 2016-09-09 17:24:24
 * @Copyright: 2016 Titor .All rights reserved.
 */



/**
 * _t 模板函数
 * @param $file
 * @param $path
 * @return mixed
 */
function _t($file, $path) {

    # 模板的后缀为.html：
    $file .= '.html';
    # 模板路径结束自动补全/
    $path .= '/';

    # 引入文件，并把文件存放成一个字符串的形式：
    $fileStr = file_get_contents($path.$file);

    # 模板定界符左：
    $pre = '{{';
    # 模板定界符右：
    $suf = '}}';

    # 替换模板中的定界符左为php开始：
    $str = str_replace($pre,'<?php', $fileStr);
    # 替换操作一半之后的模板中的定界符右为php结束：
    $str = str_replace($suf,'?>', $str);

    # 返回字符串：
    return $str;
}
