<?php

include 'head.php';
$today=date("Y-m-d ").'00:00:00';

?>


  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<?php 

	$numrows=$DB->count("SELECT count(*) from ayangw_km");
        $sycount=$DB->count("SELECT count(*) from ayangw_km where stat = 0");
	$sql=" 1";

?>
      <div class="table-responsive">
       <table class="table table-bordered">
      <tbody>
<tr height="25">
    <td align="center"><font color="#808080">
        <b><span class="glyphicon glyphicon-flag"></span> 卡密总数</b>
        </br><?php echo  $numrows;?></font></td>
<td align="center">
    <font color="#808080"><b>
      
            <span class="glyphicon glyphicon-plus-sign"></span> 剩余卡密</b>
            <br><?=$sycount?>
            </font></td>

<td align="center">
    <font color="#808080"><b>
             
            
                <?php
                if(!empty($_GET['act']) && $_GET['act'] != null && $_GET['act'] == "sousuo"){
                      echo '<a class="btn btn-info" href="kmlist.php"><span class="glyphicon glyphicon-search" ></span> 全部卡密</a> ';
                
                }else{
                      echo '<a class="btn btn-info"  data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-search" ></span> 搜索</a> ';
                }
                ?>
                
                
                </font></td>
</tr>


</tbody></table>
        
          <center>  <div class="btn-group">
    <button type="button" class="btn btn-warning" id="btn-det-ysykm">清除已使用卡密</button>
    <button type="button" class="btn btn-danger" id="btn-det-allkm">清空全部卡密</button>
    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#spModal">商品视图查看</button>
</div></center>
          <br>  <br>
        <table class="table table-striped">
          <thead><tr>
                  <th>选择</th>
                  <th>商品名称</th>
                  <th>卡密信息</th>
                  <th>导入时间</th>
                  <th>使用时间</th>
                 
                  <th>状态</th>
                  <th>操作</th>
              </tr>
          </thead>
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

if(!empty($_GET['act']) && $_GET['act'] != null && $_GET['act'] == "sousuo"){
    $pz = $_POST['pz'];
    $sql = "SELECT * FROM ayangw_km WHERE  out_trade_no like '%$pz%' or trade_no like '%$pz%' or rel  like '%$pz%' or km  like '%$pz%' or gid  like '%$pz%'  order by id desc ";
}else{
    if(!empty($_GET['tid']) && $_GET['tid'] >= 1){
        $sql = "SELECT * FROM ayangw_km WHERE gid = ".intval($_GET['tid'])." order by id desc limit $offset,$pagesize";
    }else{
        $sql = "SELECT * FROM ayangw_km WHERE{$sql} order by id desc limit $offset,$pagesize";
    }

    // echo $sql;
}

$rs=$DB->query($sql);
while($res = $DB->fetch($rs))
{
echo '<tr><td><input type="checkbox" class="chkbox" ids="'.$res['id'].'" /></td>'
        . '<td>'.getName($res['gid'],$DB).'</td><td>'.$res['km'].'</td>'
        . '<td>'.$res['benTime'].'</td><td>'.$res['endTime'].'</td><td>'.zt($res['stat']).'</td>'
        . '<td><span onclick="detkm('.$res['id'].')" class="btn btn-xs btn-primary">删除</span><span onclick="kmxxi('.$res['id'].')" class="btn btn-xs btn-info">详细</span></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
        <input  type="checkbox" onclick="allcheck(this)" /> 全选　
        <select id="km_select_exe">
            <option value="-1">将选中数据...</option>
            <option value="1">标为已使用</option>
            <option value="2">标为未使用</option>
            <option value="3">删除卡密</option>
        </select> 　
       <input type="button" value="立即执行" id="km_btn_exe">　
        
        <br>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>
  
<script src="js/ayangwfk.js"></script>
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
					搜索卡密信息
				</h4>
			</div>
			<div class="modal-body">
                           
                            <input type="text" class="form-control" name="pz" placeholder="商品ID/卡密信息/订单编号/联系方式！">
                                
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

  <!-- 模态框（Modal） -->
<div class="modal fade" id="spModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="" method="GET">	
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
						aria-hidden="true">×
				</button>
				<h4 class="modal-title" id="myModalLabel">
					选择要查看卡密的商品
				</h4>
			</div>
			<div class="modal-body">
                           <?php
                           
                           $sql = "select * from ayangw_goods";
                           $res = $DB->query($sql);
                           $option = "";
                           while ($row = $DB->fetch($res)){
                               $option.="<option value='".$row['id']."'>".$row['gName']."</option>";
                           }
                           ?>
                            <select class="form-control" name="tid">
                                <?=$option?>
                            </select>
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
<?php
function getName($id,$DB){
    $sql = "select * from ayangw_goods where id =".$id;
    $res = $DB->query($sql);
    $row = $DB->fetch($res);
    return $row['gName'];
}
function zt($z){
    if($z == 0){
        return "<font color=green>未使用</font>";
    }else if($z == 1){
        return "<font color=red>已使用</font>";
    }
}
?>
