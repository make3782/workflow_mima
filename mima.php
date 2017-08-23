<?php
/**
 * 生成密码
 *
 * @author wzx<181788481@qq.com>
 */

require_once('./workflows.php');
$workflows = new Workflows();
$query = $argv[1];              // {query}
$num = 10;                      // 生成的密码备选数量


/**
 * 生成密码的函数
 * @param $length: int 生成的密码长度
 * @param $spec_charcter: bool 是否使用特殊字符，默认为是
 *
 */
function generate_password($length = 16, $spec_charcter = true) {
    // 密码字符集，可任意添加你需要的字符
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    if ($spec_charcter) {
        $chars .= '!@#$%^&*()-_[]{}<>~`+=,.;:/?|';
    }

    $password = '';
    for ( $i = 0; $i < $length; $i++ ) {
        // 这里提供两种字符获取方式
        // 第一种是使用 substr 截取$chars中的任意一位字符；
        // 第二种是取字符数组 $chars 的任意元素
        // $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
    }

    return $password;
}

if (!is_numeric($query)) {
    die("错误的参数！\n");
}

$rtn = array();
for ($i = 0; $i < $num; $i++) {
    $tmp = generate_password($query);
    $tishi = sprintf("生成的第%d个密码", $i + 1);
    $workflows->result($tmp, $tmp, $tmp, $tishi, 'icon.png');
}

echo $workflows->toxml();




?>