<?php
/**
 * Created by PhpStorm.
 * User: K550jk
 * Date: 2017/4/14
 * Time: 15:25
 */?>
<!doctype html>
<html lang="en">
<head>
    <base href="<?php echo site_url();?>">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <meta charset="UTF-8">
    <meta name="keywords" content="王帅的个人网站"/>
    <title>我的个人网站</title>
</head>
<body>
<div class="index animated">
</div>
<div class="indexMask"></div>
<div class="nav">
    <h2 onselectstart="return false" class="title">
        王帅的个人网站
        <span>wang shuai's personal website</span>
    </h2>
    <div id="tip" class="t_tip animated"><h5>点击标题切换图片哦！</h5></div>
    <div class="n_footer">
        -><a href="person" class="person_page">个人主页</a>
    </div>
</div>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jqueryeasing.js"></script>
<script>
    $(function(){

        change();
        $(".title").on("click",function(){
           change()
        });
        function change(){
            var TOTAL = 9;
            var ANIMATE = ['bounceIn','fadeIn','fadeInDown','fadeInDownBig','fadeInLeft','fadeInRight',
                'fadeInRightBig','fadeInUp','flipInX','flipInY','lightSpeedIn','zoomIn'];
            var img = new Image();
            img.src = "assets/image/Random/"+ (Random(TOTAL)+1) +".jpg";
            var index = $(".index");
            index.removeClass().addClass("index animated");
            var animateEasing = [],   //存放JQuery animate动画效果名
                DIRECT =[['height',['top','bottom']],
                    ['width',['left','right']]];
            for(var x in $.easing){
                animateEasing.push($.easing[x].name);
            }
            (function(){
                var DIndex;
                DIndex = Random(DIRECT.length);
                var animateIndex = DIRECT[DIndex][0];
                var mPosition = DIRECT[DIndex][1][Random(DIRECT[DIndex][1].length)];
              //  console.log(mPosition);
                index.css({backgroundImage:"url(assets/image/Random/"+ (Random(TOTAL)+1) +".jpg)"});
                var animateObj = {};
                animateObj[animateIndex] =0;
                $(".indexMask").stop().delay(1000).removeAttr("style")
                    .css(mPosition,'0')
                    .animate(animateObj
                        ,1500
                        ,animateEasing[Random(animateEasing.length)]
                        ,function(){//obj中不能写key不能写变量名
                            $("#tip").addClass($("#tip").data('AnimateOut'));

                        });
                var tipRandom = ANIMATE[Random(ANIMATE.length-1)];
                $("#tip").removeClass().addClass(tipRandom+" animated").data("AnimateOut",tipRandom.replace("In","Out").replace("Down","Up"));
                index.addClass(ANIMATE[Random(ANIMATE.length-1)]);
                img = null;
            })();
            /*img.onload = function(){*/

         /*   };*/
            function Random(index){
                return Math.floor(Math.random()*index);
            }
        }
    });
</script>
<script src="assets/js/console.js"></script>
</body>
</html>
