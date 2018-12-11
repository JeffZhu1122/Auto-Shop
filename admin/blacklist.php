<?php
/**
 * 黑名单列表
**/

$title='黑名单列表 - 后台管理中心';
include './head.php';
$act = !empty($_GET['act'])? $_GET['act']:null;

if($act == "add"){
    $type = intval($_POST['type']);
    $data = daddslashes($_POST['data']);
    $remarks = daddslashes($_POST['remarks']);
    if($DB->query("insert into ayangw_blacklist values(null,$type,now(),'$data','$remarks')")){
        exit("<script language='javascript'>swal({ title: '添加成功！', text: '黑名单已增加本条记录!', icon: 'success',buttons:false,});window.location.href='./blacklist.php';</script>");
        
    }else{
        exit("<script language='javascript'>swal({ title: '添加失败！', text: '数据库插入数据失败!', icon: 'error',buttons:false,});history.go(-1);</script>");
        
    }
}elseif($act == "deletebyid"){
    $id = intval($_GET['id']);
    if($DB->query("delete from ayangw_blacklist where id=$id")){
        exit("<script language='javascript'>swal({ title: '移除成功！', text: '黑名单已移除本条记录!', icon: 'success',buttons:false,});window.location.href='./blacklist.php';</script>");
        
    }else{
            exit("<script language='javascript'>swal({ title: '添加失败！', text: '数据库删除数据失败!', icon: 'error',buttons:false,});history.go(-1);</script>");
     }
}

?>

  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<?php 
	$numrows=$DB->count("SELECT count(*) from ayangw_blacklist");
	
	$sql=" 1";

?>
      <div class="table-responsive">
       <table class="table table-bordered">
      <tbody>
<tr height="25">
    <td align="center"><font color="#808080"><b><span class="glyphicon glyphicon-hand-right"></span> 当前黑名单</b></br><?php echo  $numrows;?></font></td>
<td align="center"><font color="#808080"><b><a data-toggle="modal" data-target="#myModal2" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> 添加黑名单</a></font></td>
<td align="center"><font color="#808080"><b>
             
            <a class="btn btn-info"  data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-search" ></span> 搜索</a> 
                
                </font></td>
</tr>
</tbody></table>
      
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>类型</th><th>拉黑时间</th><th>拉黑目标</th><th>备注</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

if(!empty($act) && $act != null && $act == "sousuo"){
    $pz = $_POST['pz'];
    $sql = "SELECT * FROM ayangw_blacklist WHERE  data  like '%$pz%' or remarks like '%$pz%'   order by id desc limit $offset,$pagesize";
}else{
    $sql = "SELECT * FROM ayangw_blacklist WHERE{$sql} order by id desc limit $offset,$pagesize";
    // echo $sql;
}

$rs=$DB->query($sql);
while($res = $DB->fetch($rs))
{
echo '<tr><td>'.$res['id'].'</td><td>'.getblacktype($res['type']).'</td><td>'.$res['date'].'</td><td>'.$res['data'].'</td><td>'.$res['remarks'].'</td><td><a href="?act=deletebyid&id='.$res['id'].'" class="btn btn-danger btn-xs">移除记录</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="blacklist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="blacklist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="blacklist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="blacklist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="blacklist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="blacklist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>
  
      <!-- 模态框（Modal） -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="?act=add" method="POST">
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
						aria-hidden="true">×
				</button>
				<h4 class="modal-title" id="myModalLabel">
					添加黑名单
				</h4>
			</div>
			<div class="modal-body">
                           <select class="form-control" name="type">
                            <option value="1">拉黑下单QQ</option>
                            <option value="2">拉黑下单IP</option>
                           </select><br>
                            <input type="text" class="form-control" name="data" id="data" placeholder="目标数据"><br>
			                <br>
			                <textarea rows="5" cols="" class="form-control" name="remarks"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" 
						data-dismiss="modal">关闭
				</button>
                            <button type="submit" class="btn btn-primary">
					确定添加
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</form>
</div><!-- /.modal -->

  <!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="?act=sousuo" method="POST">	
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
						aria-hidden="true">×
				</button>
				<h4 class="modal-title" id="myModalLabel">
					搜索记录
				</h4>
			</div>
			<div class="modal-body">
                           
                            <input type="text" class="form-control" name="pz" placeholder="输入目标数据/备注！">
                                
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" 
						data-dismiss="modal">关闭
				</button>
                            <button type="submit" class="btn btn-primary">
					立即搜索
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
      </form>

</div><!-- /.modal -->

<script>

</script>