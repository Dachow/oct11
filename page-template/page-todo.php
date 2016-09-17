<?php
/*
* Template Name: TODO
*/
?>
<?php get_header() ?>
<div class="container page-todo">
<div class="jumbotron">
  <h1>TODO LIST</h1>
  <p>You have many things to do, don't be lazy.</p>
</div>
    <div class="list-group">
        <a href="#" class="list-group-item active">
            <h4 class="list-group-item-heading">标签和归档列表页面规整</h4>
            <p class="list-group-item-text">显示效果应该如同分类页面。分类页面使用截取url的方式得到当前分类id并显示，但是标签在截取中文字符时会得到两次，一个正常为中文，一个为转码后的；而且标签有输出别名的可能性。归档页面得到日期后怎么循环？</p>
        </a>
    </div>
        <div class="list-group">
        <a href="#" class="list-group-item active">
            <h4 class="list-group-item-heading">密码提示</h4>
            <p class="list-group-item-text">使用自定义字段对每篇文章生成自己的密码提示</p>
        </a>
    </div>
</div>
<?php get_footer(); ?>
