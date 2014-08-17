<?php 
	include "searchuser.inc";
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
	$obj=new SearchUser();
	$res=$obj->SelAll();
	$cnt=$obj->SelAllCount();
?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>Code Samples</title>

 <!-- ***********************************************************************************************************-->

<!-- JQUERY DATAGRID EASYUI-->
<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
	<style type="text/css">
		form{
			margin:0;
			padding:0;
		}
		.dv-table td{
			border:0;
		}
		.dv-table input{
			border:1px solid #ccc;
		}
	</style>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					ddv.panel({
						border:false,
						cache:true,
						href:'show_form.php?index='+index,
						onLoad:function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
							$('#dg').datagrid('selectRow',index);
							$('#dg').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#dg').datagrid('fixDetailRowHeight',index);
				}
			});
		});
		function saveItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? 'save_user.php' : 'update_user.php?id='+row.id;
			$('#dg').datagrid('getRowDetail',index).find('form').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(data){
					data = eval('('+data+')');
					data.isNewRecord = false;
					$('#dg').datagrid('collapseRow',index);
					$('#dg').datagrid('updateRow',{
						index: index,
						row: data
					});
				}
			});
		}
		function cancelItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			if (row.isNewRecord){
				$('#dg').datagrid('deleteRow',index);
			} else {
				$('#dg').datagrid('collapseRow',index);
			}
		}
		function destroyItem(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this user?',function(r){
					if (r){
						var index = $('#dg').datagrid('getRowIndex',row);
						$.post('destroy_user.php',{id:row.id},function(){
							$('#dg').datagrid('deleteRow',index);
						});
					}
				});
			}
		}
		function newItem(){
			$('#dg').datagrid('appendRow',{isNewRecord:true});
			var index = $('#dg').datagrid('getRows').length - 1;
			$('#dg').datagrid('expandRow', index);
			$('#dg').datagrid('selectRow', index);
		}
	</script>
<!-- ***********************************************************************************************************-->

<!-- REFRESH DATA FROM DATABASE EVERY 30 SECONDS -->	
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#load_records').load('records.php').fadeIn("slow");}, 30000); // refresh every 30000 milliseconds

</script>
  <!--[if lt IE 9]>
    <link rel="stylesheet" href="stylesheets/ie.css">
  <![endif]-->
<!-- ***********************************************************************************************************-->



</head>

<body>
	<h5>Call to Database every 30 seconds </h5><hr />
<div id="load_records"> </div>

<!--*********************CRUD APPLICATION JQUERY EASYUI**************************************************-->

<h5>Crud Application Using JQuery Easy UI</h5><hr />
	<div class="demo-info" style="margin-bottom:10px">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Click the expand button to expand a detail form.</div>
	</div>
	
	
	<table id="dg" title="Users" style="width:700px;height:350px"
			url="get_users.php"
			toolbar="#toolbar" pagination="true"
			fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="username" width="50">User Name</th>
				<th field="email" width="50">Email</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Destroy</a>
	</div>
</div>




			</div>
		</div>
	</div>
</body>
