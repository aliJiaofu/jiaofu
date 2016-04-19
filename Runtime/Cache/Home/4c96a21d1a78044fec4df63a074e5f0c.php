<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<form action="/jf/index.php/Home/Homework/uploadHomework" method="post" enctype="multipart/form-data">
    <input type="file" name="homework"/>
    <input type="submit" name="提交"/>
</form>
<a href="/jf/index.php/Home/Homework/download/rootPath/<?php echo ($url["root_path"]); ?>/file/20141002493-梁伟杰.docx">123</a>
</body>
</html>