<?php
/**
 * @FileName: tools.inc.php
 * @Created by PhpStorm.
 * @Author: Titor <foolsecret@163.com>
 * @Datetime: 2016-09-02 16:58:58
 * @Copyright: 2016 Titor .All rights reserved.
 */

/**
 * subtr 字符串截取函数
 *
 *
 * @param string $str <p>
 * 要被操作的字符串.</p>
 *
 * @param number $start <p>
 * 截取的开始位置.</p>
 *
 * @param number $length <p>
 * 截取多少位.</p>
 *
 * @param string $dir_order <p>
 * 截取的方向，从左往右和从右往左两种方案.</p>
 *
 * @return string $str <p>
 * 返回最后处理完成的字符串.</p>
 */
function subtr( $str, $start, $length, $dir_order ) {

    # 解除substr函数反向截取的方法，它的方法中，第二个参数如果为负数，就是倒着截取到第几位。
    # 结束它的这一属性，实现subtr函数的统一截取方法，构建安全的机制函数。
    # 当$start（开始截取的位置）小于0，就将它设为1，这是为了配合用户数数的习惯。
    # 输入的下标，默认从1开始，顺应用户的习惯。因为人数数是以1为开始的：
    if ($start < 0) $start = 1;
    $start -= 1;

    #if (!isset($length) || $length =='') $length = strlen($str);

    # 截取的方向的操作：
    switch ( $dir_order ) {
        # 如果为“L”、“left”、“+”方向则为从左往右：
        # 则把 $dir_order 操作方向 设为 NULL，表示“+”，正向截取。
        case "L":

            # 从左往右正常截取：
            return substr($str, $start, $length);

            break;

        # 如果为“R”、“right”、“-”方向则为从右往左：
        # 则把 $dir_order 操作方向 设为 “-”，表示反向截取。
        case "R":
            # 从右往左方向截取：

            # 颠倒字符串，从而使字符串还是正向截取：
            $new_str = strrev($str);

            # 开始截取颠倒后的字符串（反向截取）：
            $new_str = substr($new_str, $start, $length);

            # 颠倒反向字符串为正向字符串，实现正向的显示，以达到反向截取的效果,
            # 并返回该字符串（反向截取结束）：
            return strrev($new_str);

            break;

        # 如果为“ ”、“NULL”、“其他字符”方向则为从左往右：
        # 则把 $dir_order 操作方向 设为 NULL，表示正向截取。
        #default:

        # 从左往右正常截取：
        # return substr($str, $start, $length);

        # break;
    } // Switch ( $dir_name ) END

} // subtr is ending.



/**
 * aFile 检测文件是否存在。
 *
 * @param string $filepath:
 * 要检测的文件（或者包含目录名的文件）。
 *
 * @return bool：
 * 如果存在返回1。否则返回0或null。
 */
function aFile( $filepath ) {
    return file_exists($filepath);
} // aFile is ending.



/**
 * aKeys 返回数组中所有的键值：
 *
 * @param array $array:
 * 要操作的数组。
 *
 * @return array:
 * 返回数组中所有的keys（键）值。
 */
function aKeys( $array ) {
    return array_keys($array);
} // aKeys is ending.



/**
 * aValues 返回数组中所有的值
 *
 * @param array $array:
 * 要操作的数组。
 *
 * @return array:
 * 返回数组中所有的values（值）值。
 */
function aValues( $array ) {

    # 如果$array 不是数组，则返回当前的 $array 值：
    if ( ! is_array($array) ) {
        return $array;
    }

    # 反之，通过数组返回值的方式返回数组中的所有值：
    return array_values($array);
} // aValues is ending.



/**
 * arr2str 数组转为字符串:
 * 将数组的值，转换为字符串的形式。
 *
 * @param array $array:
 * 遥操作的数组。
 *
 * @return mixed|string:
 * 返回处理完成的字符串。
 */
function arr2str($array) {

    if ( is_array($array) ) {

        # 如果$array 是数组，则进行数组转换成字符串的操作：

        # 将数组转换为字符串,并以逗号分割，返回所有的字符串：
        $string = array_reduce($array, function($value1, $value2){
            return $value1 .',\''. $value2.'\'';
        });

        # 去除第一个为空的字符：
        $string = substr($string,1);

        # 返回处理完成的字符串：
        return $string;

    } else {

        # 如果$array 不是数组，则直接返回当前的 $array 值。

        return '\'' . $array . '\'';

    }
} // arr2str is ending.



/**
 * str2arr 将字符串转为数组：
 * 通过分割，把字符串转换为数组形式。
 *
 * @param string $string:
 * 要进行操作的字符串。
 *
 * @param string $separator:
 * 分割符号。
 *
 * @return array:
 * 返回分割之后数组形式的字符。
 */
function str2arr($string, $separator) {
    return explode($separator, $string);
} // str2arr is ending.



/**
 * keyInArr 向数组中，加入自定义键：
 *
 * @param string $keyValues:
 * 以逗号分割的自定义键。
 *
 * @param $array $array:
 * 要给予自定义键的数组。
 *
 * @return array $arr:
 * 返回加入自定义键之后的新数组。
 */
function keyInArr($keyValues, $array) {

    # 将输入的自定义键值以逗号分割为数组：
    $keys = str2arr($keyValues, ',');

    # 将$array 中的值全部提出（提出之后也是数组形式）：
    $values = aValues($array);

    # 定义一个承载新数组的数组：
    $arr = [];

    # 使用for循环，将自定义键和取得的值进行配对，并存入到承载数组中：
    for ($i = 0; $i < count($values); $i++) {
        $arr[trim($keys[$i])] = $values[trim($i)];
    }

    # 返回给予值之后的承载数组：
    return $arr;
} // keyInArr is ending.



# 设置php的提示信息：
function warning( $errorNumber ) {
    switch ($errorNumber) {
        case 'on':
            $error = E_ALL;
            break;
        case 'error':
            $error = E_ERROR;
            break;
        case 'warning':
            $error = E_WARNING;
            break;
        case 'parse':
            $error = E_PARSE;
            break;
        case 'notice':
            $error = E_NOTICE;
            break;
        case '0':
        case 'off':
            $error = 0;
            break;
    }

    # 设置提示信息的级别：
    error_reporting($error);
} // warning is ending.



/**
 * url2redirect 域名重定向：
 * 将输入的域名前缀，动态的给予到主域名之前，
 * 并把当前域名指向到该域名。
 *
 * @param string $urlPrefix:
 * 要给予的域名前缀。
 *
 * @return void:
 */
function url2redirect($urlPrefix) {
    return header('Location: http://'.$urlPrefix.'.example.com/');
} // url2redirect is ending.



/**
 * url2dir 域名指向到文件：
 * 将输入的文件名，动态的指向到域名后缀中，
 * 使域名动态的访问文件夹：
 *
 * @param string $dirname:
 * 要访问的文件（文件夹）名称。
 *
 * @return void:
 */
function url2dir($dirname) {
    return header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$dirname.'/');
} // url2dir is ending.



function getFileContent($file) {
    return file_get_contents($file);
}


/**
 * @param number $errorNumber:
 * 错误页面数字号码
 */
function errpage($errorNumber) {
    switch ($errorNumber) {
        case '404':
        default:
            exit( getFileContent($_SERVER['DOCUMENT_ROOT'].'/../cmd/404.html') );
    }
}
