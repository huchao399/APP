<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="/APP/Public/static/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<form action="<?php echo U('Admin/Login/checkLogin');?>" method="post">
    用户名：<input type="text" name="username">
    <br>
    密码：<input type="password" name="password">
    <br>
    验证码：<input type="text" name="code">
    <img src="<?php echo U('Admin/Login/verify');?>" onclick="this.src='<?php echo U('Admin/Login/verify');?>'"/>
    <input type="submit" value="登录">
</form>
<script>
    $("form").submit(function () {
        var userName = $("input[name='username']").val();
        var password = $("input[name='password']").val();
        var code = $("input[name='code']").val();
        if (!userName) {
            alert("请输入用户名！");
            return false;
        }
        if (!password) {
            alert("请输入请输入密码！");
            return false;
        }
        if (!code) {
            alert("请输入验证码！");
            return false;
        }
    });
</script>
</body>
</html>