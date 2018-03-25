<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test1页面测试</title>
</head>
<body>
<form action="" method="post">
    <div>当前时间：<?php echo ($dateVar); ?></div>
    用户名：<input type="text" name="user">
    <br>
    密码：<input type="password" name="password">
    <br>
    <input type="submit" value="提交">
</form>
</body>
</html>