@extends('layouts.admin')
	@section('content')
	<!--面包屑导航 开始-->
	<div class="crumb_warp">
			<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
			<i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;友情链接管理
	</div>
	<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->


	<!--结果页快捷搜索框 结束-->

	<!--搜索结果页面 列表 开始-->
	<form action="#" method="post">
			<div class="result_wrap">
				<div class="result_title">
					<h3>友情链接列表</h3>
				</div>
					<!--快捷导航 开始-->
					<div class="result_content">
							<div class="short_wrap">
									<a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>添加链接</a>
									<a href="{{url('admin/links')}}"><i class="fa fa-refresh"></i>全部链接</a>
							</div>
					</div>
					<!--快捷导航 结束-->
			</div>

			<div class="result_wrap">
					<div class="result_content">
							<table class="list_tab">
									<tr>
											<th class="tc" width="5%">排序</th>
											<th class="tc"width="5%">ID</th>
											<th>友情链接名称</th>
											<th>友情链接标题</th>
											<th>链接地址</th>
											<th></th>
									</tr>

									@foreach($data as $v)


									<tr>
											<td class="tc">
													<input type="text" onchange="changeOrder(this,{{$v->link_id}})" value="{{$v->link_order}}">
											</td>

											<td class="tc">{{$v->link_id}}</td>
											<td>

													<a href="#">{{$v->link_name}}</a>
											</td>
											<td>{{$v->link_title}}</td>
											<td>{{$v->link_url}}</td>

											<td>
													<a href="{{url('admin/links/'.$v->link_id.'/edit')}}">修改</a>
													<a href="javascript::" onclick="delLink({{$v->link_id}})">删除</a>
											</td>
									</tr>
									@endforeach

							</table>







					</div>
			</div>
	</form>
	<!--搜索结果页面 列表 结束-->
<script>
function changeOrder(obj,link_id){
	var link_order=$(obj).val();
	$.post("{{url('admin/links/changeorder')}}",{'_token':'{{csrf_token()}}','link_id':link_id,'link_order':link_order},function(data){

		if(!data.status){
			layer.msg(data.msg,{icon:5});
		}else{
			layer.msg(data.msg,{icon:5});
		}
	});
}


function delLink(link_id){

	layer.confirm('是否删除分类？', {
	  btn: ['确认','取消']
	},function(){
			$.post("{{url('admin/links/')}}/"+link_id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
				if(data.status==0){
					location.href = location.href;
					layer.msg(data.msg, {icon: 1});
				}
				else{
					layer.msg(data.msg, {icon: 1});
				}
			});

	},function(){

	});
}


</script>



	@endsection
