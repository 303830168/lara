<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
        body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.1">




    //这个需要单独申请，只有获取到这个密匙那么才可以使用百度地图

    //获取密钥地址：http://lbsyun.baidu.com/index.php?title=jspopular进入之后点击获取密钥
    </script>
    <title>浏览器定位</title>
</head>
<body>
    <div id="allmap"></div>
</body>
</html>
<script type="text/javascript">
    // 百度地图API功能
    var map = new BMap.Map("allmap");
    var point = new BMap.Point(100.331398,39.897445);
    map.centerAndZoom(point,12);

//以上参数不用设置

//以下是获取当前的地理位置

    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){

            //表示获取成功那么 r 这个参数就包含有当前的地理位置经纬度

            　　　　//逆地址解析，就是要把当前的经纬度转为当前具体地理位置
            　　　　//逆地址解析
            　　　　　　var geoc = new BMap.Geocoder();
            　　　　　　var pt = new BMap.Point(p_x, p_y);//实例化这两个点
            　　　　　　geoc.getLocation(pt, function (rs) {
                　　　　　　　　var addComp = rs.addressComponents;
                　　　　　　　　$('.its-place').html(addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber)
　　　　　　　　alert(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);

　　　　　　　　//对应的省市区、县街道，街道号
　　　　});

        }else {
            alert('failed'+this.getStatus());
        }
    },{enableHighAccuracy: true})
    //关于状态码
    //BMAP_STATUS_SUCCESS    检索成功。对应数值“0”。
    //BMAP_STATUS_CITY_LIST    城市列表。对应数值“1”。
    //BMAP_STATUS_UNKNOWN_LOCATION    位置结果未知。对应数值“2”。
    //BMAP_STATUS_UNKNOWN_ROUTE    导航结果未知。对应数值“3”。
    //BMAP_STATUS_INVALID_KEY    非法密钥。对应数值“4”。
    //BMAP_STATUS_INVALID_REQUEST    非法请求。对应数值“5”。
    //BMAP_STATUS_PERMISSION_DENIED    没有权限。对应数值“6”。(自 1.1 新增)
    //BMAP_STATUS_SERVICE_UNAVAILABLE    服务不可用。对应数值“7”。(自 1.1 新增)
    //BMAP_STATUS_TIMEOUT    超时。对应数值“8”。(自 1.1 新增)
</script>