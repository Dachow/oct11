$(document).ready(function(){

  // 导航hover下拉
  $(".menu-item-has-children").hover(function () {
    // $(this).children("a").attr("href", "#");
    $(".dropdown-menu").toggle();
  });

  // 轮播图第一张添加active类
  $(".page-slider .carousel-inner > .item").eq(0).addClass("active");

  // 主页文章摘要图样式
  // $(".index-page .content img").addClass("img-rounded");
});
