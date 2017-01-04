
@extends('layouts.admin')
@section('content')

	 <!--面包屑导航 开始-->
	 <div class="crumb_warp">
			 <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
			 <i class="fa fa-home"></i> <a href="">首页</a> &raquo; 新增求购

	 </div>
	 <!--面包屑导航 结束-->

 <!--结果集标题与导航组件 开始-->
 <div class="result_wrap">

			 <div class="result_content">
					 <div class="short_wrap">
						 <a href="{{url('admin/offer/create')}}"><i class="fa fa-plus"></i>添加求购</a>
						 <a href="{{url('admin/offer')}}"><i class="fa fa-refresh"></i>全部求购</a>
					 </div>
			 </div>
	 </div>
	 <!--结果集标题与导航组件 结束-->
	 <div class="result_wrap">
			 <div class="result_title">
				 <h3>添加您的求购</h3>

					 @if(count($errors)>0)
							 <div class="mark">
								 @if(is_object($errors))
									 @foreach($errors->all() as $error)
											 <p>{{$error}}</p>
									 @endforeach
								 @else
									 <P>{{$errors}}</p>
								 @endif
							 </div>
					 @endif
			 </div>
	 </div>

	 <div class="result_wrap">
			 <form action="{{url('admin/offer/'.$offer->offer_id)}}" method="post">
				 <input type="hidden" name="_method" value="put">
				 {{csrf_field()}}
					 <table class="add_tab">
							 <tbody>

								 <tr>
										 <th> 求购标题：</th>
										 <td>
												 <input type="text" class="lg" name="offer_title" value="{{$offer->offer_title}}">

										 </td>
								 </tr>
								 
				                 <tr>
				                     <th> 缩略图：</th>
				                     <td>

				                        <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
				                        <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
				                        <script type="text/javascript">
				                            <?php $timestamp = time();?>
				                            $(function() {
				                                $('#file_upload').uploadify({
				                                    'buttonText':'上传图片',
				                                    'formData'     : {
				                                        'timestamp' : '<?php echo $timestamp;?>',
				                                        '_token'     : '{{csrf_token()}}',

				                                    },
				                                    'swf'      : "{{asset('resources/org/uploadify/uploadify.swf')}}",
				                                    'uploader' : "{{url('admin/upload')}}",
				                                    'onUploadSuccess':function(file,data,response){
				                                        $('input[name=art_thumb]').val(data);
				                                        $("#art_thumb_img").attr('src','/'+data);
				                                    }
				                                });
				                            });
				                        </script>
				                        <style>
				                        .uploadify{display:inline-block;}
				                        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
				                        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
				                        </style>


				                    <input type="text" size="50" name="art_thumb" value="{{$offer->art_thumb}}">
				                    <input id="file_upload" name="file_upload" type="file" multiple="true">


				                     </td>
				                </tr>
				                
				                <tr>
				                        <th> </th>
				                        <td>
				                                <img  id="art_thumb_img" style="max-width:350px;max-height:150px"  src="/{{$offer->art_thumb}}">

				                        </td>
				                </tr>
									<tr>
										 	<th>详细内容：</th>
											 <td>
											 <style>
													.edui-default{line-height: 28px;}
													div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
													{overflow: hidden; height:20px;}
													div.edui-box{overflow: hidden; height:22px;}
												</style>
											 <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
											 <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
											 <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
											 <script id="editor" name="offer_content" type="text/plain" style="width:860px;height:350px;"></script>
											 <script type="text/javascript">
											 var ue = UE.getEditor('editor');
				                             ue.ready(function(){//监听编辑器实例化完成的事件
				                            
				                            	 ue.setContent("{!!$offer->offer_content!!}");
				                            })

											 </script>

											 </td>
									</tr>

											 <th></th>
											 <td>
													 <input type="submit" value="提交">
													 <input type="button" class="back" onclick="history.go(-1)" value="返回">
											 </td>
									 </tr>
							 </tbody>
					 </table>
			 </form>
	 </div>
@endsection
