<div class="box3">

    <div class="box3_title">
        <div class="title_left"><a href="">设计与策划服务 <span>/</span></a><span class="small">Design</span></div>
        <div class="title_right">
            <ul>
                @if(isset($recm1))
                    @foreach($recm1 as $k => $r)
                        <li class="@if($k == 0) hover @endif" id="cehua{{$k+1}}"
                            onMouseover="setTab('cehua',{{$k+1}},4)">{{array_keys($r)[0]}}<a href="#">
                            </a></li>
                    @endforeach
                @endif
                <a href="{{url('cate')}}" target="_blank"><img src="{{asset('resources/views/home/images/more.jpg')}}"
                                                               alt=""/></a>
            </ul>
        </div>
    </div>
    <div class="box3_cone">




        @foreach($recm1 as $k => $v)
            <div id="con_cehua_{{$k+1}}" class="@if($k == 0) display @else hidden  @endif"
                 style="display: @if($k == 0) block @else none  @endif;">
                <div class="rollBox mt20">
                    <div class="LeftBotton" onmousedown="ISL_GoUp()" onmouseup="ISL_StopUp()"
                         onmouseout="ISL_StopUp()"></div>
                    <div class="RightBotton" onmousedown="ISL_GoDown()" onmouseup="ISL_StopDown()"
                         onmouseout="ISL_StopDown()"></div>
                    <div class="Cont" id="ISL_Cont">
                        <div class="ScrCont">
                            <div id="List1">
                                <!-- 文章循环 -->

                                <ul>

                                    @if(isset($v))
                                        @if($v['recm_type'] == 0)
                                            @foreach(array_values($v)[0] as $arts)
                                                @if(!empty($arts))
                                                    <li>
                                                        <a href="{{url('a1/'.$arts->art_id)}}"><img
                                                                    src="{{asset($arts->art_thumb)}}"/></a>
                                                        <div class="bto-gu">
                                                            <h1><a href="">{{$arts->art_title}}</a></h1>
                                                            <p><a href="">{{$arts->created_at}}</a></p>
                                                            <a href="{{url('a1/'.$arts->art_id)}}"><span>MORE</span></a>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach(array_values($v)[0] as $arts)
                                                @if(!empty($arts))
                                                    <li>
                                                        <a href="{{url('a2/'.$arts->art_id)}}"><img
                                                                    src="{{asset($arts->art_thumb)}}"/></a>
                                                        <div class="bto-gu">
                                                            <h1><a href="">{{$arts->art_title}}</a></h1>
                                                            <p><a href="">{{$arts->created_at}}</a></p>
                                                            <a href="{{url('a2/'.$arts->art_id)}}"><span>MORE</span></a>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                </ul>
                            </div>
                            <div id="List2"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <script type="text/javascript" src="{{asset('resources/views/home/js/honor.js')}}"></script>
                <!-- {{asset('resources/views/home/js/honor.js')}} -->
                    <div class="clear"></div>
                </div>
            </div>
        @endforeach

    </div>
</div>
