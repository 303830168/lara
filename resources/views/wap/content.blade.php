<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>信息详细页介绍</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <style>
            *{margin: 0; padding: 0;}
            body {font-size: 1rem; font-family: "微软雅黑"; background:#f2f4f8;}
            a {text-decoration: none; color: #000;}
            ul li {list-style: none;}
            .content p {font-size: 0.855rem; line-height: 1.5rem; letter-spacing:0.15rem;}
            .box{max-width: 720px ; min-width: 320px; width: 100%; margin: auto; }
            /*banner*/
            .banner_box{width:100%;text-align:center;margin:0 auto;position:relative;overflow:hidden;z-index:5;background:#F8F8F8; margin-top:3.75rem;}
            .swiper-container {height:6.5rem;width:100%;text-align:center;margin:0 auto;position:relative;overflow:hidden;z-index:5;margin-bottom: 0.2rem; background:#F8F8F8; }
            .swiper-wrapper {position: relative;z-index:10;}
            .swiper-slide {position:relative;text-align:center;float:left;}
            .swiper-slide a{position:relative;width:100%;height:100%;display:block;overflow:hidden;}
            .swiper-slide img{width:100%;height:100%;vertical-align:middle;position:relative;}
            .pagination{position:absolute;height:1.2rem;width:100%;bottom:0.875rem;z-index:100;}
            .pagination .swiper-pagination-switch{display:inline-block;height:0.5em;width:0.5em;background:#FFF;border-radius:50%;margin-right:1em;}
            .pagination .swiper-active-switch{background:#fe5e52;}
            .b_header {position: relative; height: 4rem; line-height: 4rem; overflow: hidden;}
            .b_header a img {width: 8rem; height: 4rem;}
            .header_r {width: 100%; height: 4rem; overflow: hidden;  position: absolute;  top: 0;  left: 8rem; background: #fff;  text-align: center;}
            .content {width: 100%;}
            .content .c_title {width: 100%; background: #fff; font-size: 0.5rem;}
            .content .c_title p {padding: 0.3rem 1.3333rem;}
            .content .c_box {margin-left: 2rem; margin-right: 2rem;}
            .content img {width: 100%; height: auto;}
            /*底部分享*/
            .fenxiang {height: 3rem; padding-top: 1rem;}
            .fenxiang ul li  {float: left; }
            .fenxiang a {background: url(img/fenxiang.png) no-repeat; display: block; width: 2rem; height: 2rem;}
            .fenxiang .weibo {background-position: 3px -54px;}
            .fenxiang .weixin {background-position: -28px -54px;}
            .fenxiang .qqhaoyou {background-position: -59px -54px;}
            .footer {text-align: center;  width: 100%; }
            .footer .copy {font-size: 0.8rem; color: #999;}
            .ewm img {width: 6rem; height: 6rem;}
            .more { text-align: center; }
            .more p {color: red;}
        </style>
        <script type="text/javascript" src="{{asset('resources/views/wap/js/jquery-1.10.2.min.js')}}" ></script>
        <script type="text/javascript" src="{{asset('resources/views/wap/js/swiper-2.1.min.js')}}" ></script>
        <script type="text/javascript" src="{{asset('resources/views/wap/js/media-query.js')}}" ></script>
    </head>
    <body>
    {{--地址判断--}}



    {{--分享接口--}}

    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>

        wx.config({
            debug: false,
            appId: 'wx260619ea73a4b130',     // 必填，公众号的唯一标识
            timestamp: {{$timestamp}}, // 必填，生成签名的时间戳
            nonceStr: "{{$nonceStr}}", // 必填，生成签名的随机串
            signature: "{{$signature}}",// 必填，签名，见附录1
            jsApiList: ['onMenuShareTimeline'],
            openId:1
        });

        wx.ready(function () {

            //--确认微信版本地址
            wx.checkJsApi({
                jsApiList: [
                    'getLocation'
                ],
                success: function (res) {
                    //alert(JSON.stringify(res));
                    //alert(JSON.stringify(res.checkResult.getLocation));
                    if (res.checkResult.getLocation == false) {

                        alert('你的微信版本太低，请升级到最新的微信版本！');
                        location.href = "/wap/self_media";
                        return;
                    }
                }
            });
            //--确认微信版本地址 end

            //--调取地址
            wx.getLocation({
                success: function (res) {
                    var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                    var speed = res.speed; // 速度，以米/每秒计
                    var accuracy = res.accuracy; // 位置精度


                    //ajax 获取信息 并显示页面

                    $.post("{{url('wap/self_media/check_location')}}",
                            {
                                'latitude': latitude,
                                'longitude': longitude,
                                'accuracy': accuracy,
                                '_token': "{{csrf_token()}}",
                                'media_id':"{{$media_id}}",
                            }, function (data) {

                                //判断是否可以分享此内容 如果不行则返回到主页 如果可以就继续执行
                                if(data == 'false'){
                                    alert('您的区域无法分享该内容');
                                    location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx260619ea73a4b130&redirect_uri=http://adbangbang.com/wap/self_media1&response_type=code&scope=snsapi_base&state=123#wechat_redirect";
                                }
                                //alert(data);
                            });

                },
                cancel: function (res) {
                    alert('用户拒绝授权获取地理位置');
                    location.href = "/wap/self_media";
                }
            });
            //--调取地址 end


            //----分享定制
            var shareData = {
                title: '这个秘密我只告诉你哦！'+"{{$content->title}}",
                desc: '无穷大分享 分享抢红包 分享有惊喜！',
                link: 'http://adbangbang.com/wap/self_media/' + "{{$media_id}}",
                imgUrl: "{{asset('resources/views/home/images/logo.jpg')}}",
                success: function () {
                    // 用户确认分享后执行的回调函数
                    // 将此文章id 和 OPENID 存入数据库
                    window.open("https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx260619ea73a4b130&redirect_uri=http://adbangbang.com/sharesuccess/" + "{{$media_id}}" + "&response_type=code&scope=snsapi_base&state=123#wechat_redirect");
                },
                cancel: function () {
                    alert('取消分享');
                    // 用户取消分享后执行的回调函数
                }
            };

            wx.onMenuShareAppMessage(shareData);
            wx.onMenuShareTimeline(shareData);
            // ----分享定制


        });

        wx.error(function (res) {
            alert(res.errMsg);
        });
    </script>




    {{--菜单--}}
        <div class="box">
            <div class="b_header">
                <a href="#"><img src="{{asset('resources/views/wap/images/logo.jpg')}}"/> </a>
                <div class="header_r"><p>无穷大网络信息服务平台正式上线了！...无穷大网络信息服务</p></div>
            </div>  
            <div class="swiper-container">
                    <div class="swiper-wrapper" id="swiper-wrapper">
                        <div class="swiper-slide"><a href="#"><img src="{{asset('resources/views/wap/images/qmts.jpg')}}" alt=""></a></div>
                        <div class="swiper-slide"><a href="#"><img src="{{asset('resources/views/wap/images/qmts.jpg')}}" alt=""></a></div>
                        <div class="swiper-slide"><a href="#"><img src="{{asset('resources/views/wap/images/qmts.jpg')}}" alt=""></a></div>
                    </div>
                    <div class="pagination"></div>
            </div>

            <div class="content">
                <div class="c_title"> <p>发布时间 {{$content->created_at}}</p>  </div>
                <div class="c_box">
                @if($content)
                <p>{!! $content->content !!}</p>
                @endif
                </div>
            </div>

            <div class="footer">
                <div>
                    <p class="copy">©2015-2017无穷大网络信息服务平台版权所有</p>           
                </div>
                <div class="ewm">
                    <img src="{{asset('resources/views/wap/images/ewm.jpg')}}" />
                </div>
                <div class="more">
                    <p>关注微信公众号 查看更多分享推广哦</p>
                </div>
            </div>
        </div>
    </body>
</html>
