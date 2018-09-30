<?php
    $ketnoi['host'] = 'localhost'; //Tên server, nếu dùng hosting free thì cần thay đổi
    $ketnoi['dbname'] = 'thitracnghiem'; //Đây là tên của Database
    $ketnoi['username'] = 'root'; //Tên sử dụng Database
    $ketnoi['password'] = '';//Mật khẩu của tên sử dụng Database
  $connect= mysqli_connect($ketnoi['host'],$ketnoi['username'] ,$ketnoi['password']) or
        die("Không thể kết nối database");
    mysqli_select_db($connect,$ketnoi['dbname'])    or
        die("Không thể chọn database");
?>