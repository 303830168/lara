
@extends('layouts.admin')
@section('content')

	 <!--面包屑导航 开始-->
	 <div class="crumb_warp">
			 <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
			 <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 修改自定义导航

	 </div>
	 <!--面包屑导航 结束-->

 <!--结果集标题与导航组件 开始-->

	 <!--结果集标题与导航组件 结束-->
	 <div class="result_wrap">
			 <div class="result_title">
				 <h3>修改自定义导航</h3>
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
			 <form action="{{url('admin/navs/'.$field->nav_id)}}" method="post">
				 {{method_field('put')}}
				 {{csrf_field()}}
					 <table class="add_tab">
							 <tbody>

								 <tr>
										 <th><i class="require">*</i>导航名称：</th>
										 <td>
												 <input type="text" name="nav_name" value="{{$field->nav_name}}">
												 导航别名：
												 <input type="text" class="sm" name="nav_alias" value="{{$field->nav_alias}}">
												 <span><i class="fa fa-exclamation-circle yellow"></i>导航名称必须填写</span>
										 </td>
								 </tr>
								 <tr>
										 <th><i class="require">*</i>Url：</th>
										 <td>
												 <input type="text" name="nav_url" value="{{$field->nav_url}}">
										 </td>
								 </tr>

								 <tr>
										<th>排序：</th>
										<td>
												<input type="text" class="sm" name="nav_order" value="{{$field->nav_order}}">
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
