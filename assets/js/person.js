define(function(require){
    var $ = require("jquery");
    $(function(){
     var nav = (function(){
            var nav ={
                init:function(){
                    this.select();
                },
                select:function(){
                    $(".nav_bar").on("click","li",function(){
                        nav.scroll($(this).data("height"));
                        $(this).addClass("nav_active").siblings().removeClass("nav_active");
                    });
                },
                scroll:function(height){
                    $("body").animate({scrollTop:height-50},500);
                }
            };
            return nav;
        })();
        nav.init();
      var lunbo = (function(){
            var lunbo = {
                lunbo:{},
                perWidth:0,
                length:0,        //li的实际个数
                index:0,
                init:function(){
                    this.lunbo = $(".l_content");
                    if(this.lunbo.find("li").length>0){
                        $(".l_content").append($(".l_content>li").eq(0).clone());
                        this.length = $(".l_content>li").length;
                        this.perWidth = $(".l_content>li").outerWidth();
                        this.run();
                        this.resize();  //窗口重置
                        this.mouseOver();  //mouseover事件
                        this.lunbo_bar();
                    }

                },
                mouseOver:function(){
                    var _this = this;
                    $(".de_right").on("mouseenter",function(e){
                        e.stopPropagation();
                        e.stopImmediatePropagation();
                        clearInterval(_this.runing);
                    }).on("mouseleave",function(e){
                        _this.run();

                    });
                    $(".de_right").on("click",function(e){
                        e.preventDefault();
                        return false;
                    });
                },
                prev:function(){
                    this.index--;
                    if(this.index == -1){
                        this.index = this.length-1;
                        this.lunbo.css({"left":-this.index*this.perWidth});
                        this.index--;
                    }
                    this.change();
                },
                next:function(){
                    this.index++;
                    if(this.index == this.length){    //this.length  li的实际个数
                        this.index = 0;
                        this.lunbo.css({"left":-this.index*this.perWidth});
                        this.index++;
                    }
                    this.change();
                },
                lunbo_bar:function(){
                    var _this = this;
                    $(".lunbo_bar").on("click","li",function(){
                        _this.index = $(this).index();
                        _this.change();
                    });
                },
                change:function(){
                    var length = $(".lunbo_bar>li").length;
                    if(this.lunbo.position().left == -length*this.perWidth){
                        this.lunbo.css({"left":0});
                    }
                    $(".lunbo_bar li").eq(this.index%length).addClass("active").siblings().removeClass("active");
                    this.lunbo.stop().animate({"left":-this.index*this.perWidth},500);
                },
                run:function(){
                   this.runing = setInterval(function(){
                        lunbo.next()
                    },10000);
                },
                resize:function(){
                    var _this = this;
                    $(window).resize(function(){
                            clearInterval(_this.runing);
                            _this.perWidth = $(".l_content>li").outerWidth();
                            _this.lunbo.css({"left":-_this.index*_this.perWidth});
                            _this.run();

                    });
                }
            };
            return lunbo;
            }
        )();

        lunbo.init();
    });
});
