$(document).ready(function(){
  $(".menu-item-has-children").hover(function () {
    // $(this).children("a").attr("href", "#");
    $(".dropdown-menu").toggle();
  });

});
