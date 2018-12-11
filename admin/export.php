<?php
include '../ayangw/common.php';


$act = empty($_GET['act'])?null:$_GET['act'];
$gid = intval($_GET['id']);

if($act == "ex_sykm"){
    $gName = $_GET['gname'];
    $res = $DB->query("select * from ayangw_km where gid=$gid and stat = 0");
    $data = "";
    while ($row = $DB->fetch($res)) {
        $data = $data.$row['km']. "\r\n";
    }
    $file_name=$gName.'_剩余卡密_'.time().'.txt';
    $file_size=strlen($data);
    header("Content-Description: File Transfer");
    header("Content-Type:application/force-download");
    header("Content-Length: {$file_size}");
    header("Content-Disposition:attachment; filename={$file_name}");
    echo $data;
}elseif($act == "ex_ysykm"){
    $gName = $_GET['gname'];
    $res = $DB->query("select * from ayangw_km where gid=$gid and stat = 1");
    $data = "";
    while ($row = $DB->fetch($res)) {
        $data = $data.$row['km']. "\r\n";
    }
    $file_name=$gName.'_已使用卡密_'.time().'.txt';
    $file_size=strlen($data);
    header("Content-Description: File Transfer");
    header("Content-Type:application/force-download");
    header("Content-Length: {$file_size}");
    header("Content-Disposition:attachment; filename={$file_name}");
    echo $data;
}elseif($act == "ex_allkm"){
    $gName = $_GET['gname'];
    $res = $DB->query("select * from ayangw_km where gid=$gid");
    $data = "";
    while ($row = $DB->fetch($res)) {
        $data = $data.$row['km']. "\r\n";
    }
    $file_name=$gName.'_全部卡密_'.time().'.txt';
    $file_size=strlen($data);
    header("Content-Description: File Transfer");
    header("Content-Type:application/force-download");
    header("Content-Length: {$file_size}");
    header("Content-Disposition:attachment; filename={$file_name}");
    echo $data;
}