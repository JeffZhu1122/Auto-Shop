<?php
include 'head.php';
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
        
        <?php
        if($my =="e_submit"){
            $id = intval($_GET['id']);
            $name = daddslashes($_POST['name']);
            $sql = "update ayangw_type set tName = '".$name."' where id = ".$id;
            if($DB->query($sql)){
                @header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('修改成功！');window.location.href='typelist.php';</script>");
            }else{
                 @header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('修改失败！');history.go(-1);</script>");
            }
        }elseif($my == "xiajia"){
            $id = intval($_GET['id']);
            $sql = "update ayangw_type set state = 0 where id = ".$id;
            if($DB->query($sql)){
                @header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('修改成功！');window.location.href='typelist.php';</script>");
            }else{
                 @header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('修改失败！');history.go(-1);</script>");
            }
        }elseif($my == "shangjia"){
            $id = intval($_GET['id']);
            $sql = "update ayangw_type set state = 1 where id = ".$id;
            if($DB->query($sql)){
                @header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('修改成功！');window.location.href='typelist.php';</script>");
            }else{
                 @header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('修改失败！');history.go(-1);</script>");
            }
        }elseif($my == "delete"){
            $id = intval($_GET['id']);
            $sql = "delete from  ayangw_type  where id = ".$id;
            if($DB->query($sql)){
                @header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('删除成功！');window.location.href='typelist.php';</script>");
            }else{
                 @header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('删除失败！');history.go(-1);</script>");
            }
        }elseif($my == "add_submit"){
             $name = daddslashes($_POST['name']);
             $sql = "insert into ayangw_type value(null,'$name',1)";
            if($DB->query($sql)){
                @header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('添加成功！');window.location.href='typelist.php';</script>");
            }else{
                 @header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('添加失败！');history.go(-1);</script>");
            }
        }
        ?>
<div class="panel panel-primary">
	<div class="panel-heading">
		商品分类
	</div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>名称</th><th>操作</th></tr></thead>
          <tbody>
              <?php
             $sql = "select * from ayangw_type";
            $res = $DB->query($sql);
        
            while ($row = $DB->fetch($res)){
                if($row['state'] == 0){
                      $btn = '<a href="./typelist.php?my=shangjia&id='.$row['id'].'"  class="btn btn-sm btn-warning" >已下架</a>';
                    
                }else{
                  $btn = '<a href="./typelist.php?my=xiajia&id='.$row['id'].'"  class="btn btn-sm btn-success" >上架中</a>';
                }
                ?>
          <form action="typelist.php?my=e_submit&id=<?=$row['id']?>" method="POST" class="form-inline">
    <tr>
      
        <td><input type="text" class="form-control input-sm" name="name" value="<?=$row['tName']?>" placeholder="分类名称" required></td>
        <td><button type="submit" class="btn btn-primary btn-sm">修改</button>&nbsp;
           <?=$btn?> &nbsp;
            <a href="./clist.php?cid=<?=$row['id']?>" class="btn btn-warning btn-sm">商品</a>&nbsp;
            <a href="./typelist.php?my=delete&id=<?=$row['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('你确实要删除此商品吗？');">删除</a>
        </td>
    </tr>
</form>    
               <?php
              
            }
              ?>

          <form action="typelist.php?my=add_submit" method="POST" class="form-inline" >
              
         <tr>
            
             <td>
                 <input type="text" class="form-control input-sm" name="name" placeholder="分类名称" required>
             </td>
             <td colspan="3">
                 <button type="submit" class="btn btn-success btn-sm">
                     <span class="glyphicon glyphicon-plus"></span> 添加分类</button>
             </td>
         </tr>
     </form> 
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
