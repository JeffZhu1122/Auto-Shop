<?php
/**
 * 系统运行日志
**/

$title='系统运行日志 - 后台管理中心';
include './head.php';
?>

  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<?php 
	$numrows=$DB->count("SELECT count(*) from ayangw_syslog");
	
	$sql=" 1";
	$con='系统共有 <b>'.$numrows.'</b>条运行日志。<a onclick="detlog()" style="color:red;">全部清空</a>';


echo $con;
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>名称类型</th><th>运行时间</th><th>详细日志</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM ayangw_syslog WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td>'.$res['id'].'</td><td>'.$res['log_name'].'</td><td>'.$res['log_time'].'</td><td>'.$res['log_txt'].'</td></tr>';
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
echo '<li><a href="loglist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="loglist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="loglist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="loglist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="loglist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="loglist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>
<script>

</script>