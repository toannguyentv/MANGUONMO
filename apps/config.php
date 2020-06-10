<?php
// $base = str_replace($_SERVER['DOCUMENT_ROOT'],'',str_replace('\\','/',dirname(__FILE__,1)));
$base = '/manguonmo';
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'webbanhang';
$conn = mysqli_connect($host,$username,'',$database);
if (!$conn) die ('Không thể kết nối cơ sở dữ liệu');

mysqli_set_charset($conn,'utf8_general_ci');
/*mysqli_close($conn);*/
session_start();
?>