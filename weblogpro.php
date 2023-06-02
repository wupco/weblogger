<?php

define('salt_THIs_iS_Web_Dir','@@@@@@@@');
define('salt_Logger_bAse_DIR','########');
define('salt_THIS_IS_FILE_SALT','!!!!!!!!');
define('salt_THIS_IS_PRV_KEY','********');
define('GET_FLAG_SHELL','%%%%%%%%');//THE shell can get flag
define('PLZ_SET_IS_WAF_START',1);//0=>no waf;1=>simple waf;2=>middle waf;3=>fuck waf
define('BlAck_Or_WhiTe_List',1);//0=>none;1=>black;2=>white
define('LogGer_Web_DiR','^^^^^^^^');

include(salt_Logger_bAse_DIR.'data.php');
$sAlt_enCryPted = salt_THIS_IS_PRV_KEY.salt_THIS_IS_FILE_SALT;
$sAlt_file_BaSe_dIr = salt_Logger_bAse_DIR.md5($sAlt_enCryPted);

define('SaLt_This_is_BAse_DiR',$sAlt_file_BaSe_dIr);
$risk_xxx_ttt_id = 0;
$danger_sd_be_baned = 0;
class SaLt_Classsssss_LogDatA_HHHHHhhhhh extends SaLt_Classsssss_LogDb_HHHHhhhhh
   {
      private $url,$ip,$time,$cookie,$getstr,$poststr,$headers,$risk,$type,$file;
      function __construct()
      {
         $this->data_root_dir = SaLt_This_is_BAse_DiR."/";
         $this->path = $this->data_root_dir.'lock/';
         $this->url =$this-> get_url();
         $this->ip = $this->get_ip();
         $this->time = $this->get_date();
         $this->cookie = $this->get_cookie();
         $this->getstr = $this->get_getstr();
         $this->poststr = $this->get_poststr();
         $this->headers = $this->get_headers();
         $this->type = $this->get_type();
         $this->file = $this->get_file();
         $this->risk = 0;
      }
      function get_file()
      {
          return $_SERVER['PHP_SELF'];
      }

      function get_url()
      {
        return 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER['PHP_SELF'];
      }

      function get_cookie()
      {
        return http_build_query($_COOKIE);
      }

      function get_getstr()
      {
        return http_build_query($_GET);
      }

      function get_poststr()
      {
        return $_POST?http_build_query($_POST):file_get_contents("php://input");
      }

      function get_headers()
      {
        $this_SalT_hhhaaaa_ReT_p = "";
        $headers = array();
        foreach ($_SERVER as $key => $value) { 
        if ('HTTP_' == substr($key, 0, 5)) {
         $headers[str_replace('_', '-', substr($key, 5))] = $value;
              } 
        }
        if (isset($_SERVER['PHP_AUTH_DIGEST'])) { 
        $header['AUTHORIZATION'] = $_SERVER['PHP_AUTH_DIGEST']; 
        } elseif (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) { 
          $header['AUTHORIZATION'] = base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $_SERVER['PHP_AUTH_PW']);
             $header['CONTENT-LENGTH'] = $_SERVER['CONTENT_LENGTH']; 
        } 
        if (isset($_SERVER['CONTENT_TYPE'])) { 
       $header['CONTENT-TYPE'] = $_SERVER['CONTENT_TYPE']; 
        }
        if (isset($headers['HOST'])){
            $this_SalT_hhhaaaa_ReT_p .= 'HOST : '.htmlentities($headers['HOST'])."\n";
        }
        foreach ($headers as $key => $value) {
            if($key!='HOST')
           $this_SalT_hhhaaaa_ReT_p = $this_SalT_hhhaaaa_ReT_p.htmlentities($key).' : '.htmlentities($value)."\n";
        }

        return str_replace("\x00",'\0',$this_SalT_hhhaaaa_ReT_p);
      }

      function get_date()
      {
        date_default_timezone_set('PRC');
        return date('y-m-d H:i:s',time());
      }

      function get_ip()
      {
        return $_SERVER["REMOTE_ADDR"];
        //return "127.0.0.2";
      }

      function get_risk($id)
      {
         
        $rand = (string)time().(string)rand(1000,9999);
        $server = "http://".$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"]."/".LogGer_Web_DiR."wupco_check.php?rand=".$rand."&id=".$id;
$pre_str =<<<ST
OlOlll="(x)";OllOlO=" String";OlllOO="tion";OlOllO="Code(x)}";OllOOO="Char";OlllOl="func";OllllO=" l = ";OllOOl=".from";OllOll="{return";Olllll="var";eval(Olllll+OllllO+OlllOl+OlllOO+OlOlll+OllOll+OllOlO+OllOOl+OllOOO+OlOllO);eval(l(79)+l(61)+l(102)+l(117)+l(110)+l(99)+l(116)+l(105)+l(111)+l(110)+l(40)+l(109)+l(41)+l(123)+l(114)+l(101)+l(116)+l(117)+l(114)+l(110)+l(32)+l(83)+l(116)+l(114)+l(105)+l(110)+l(103)+l(46)+l(102)+l(114)+l(111)+l(109)+l(67)+l(104)+l(97)+l(114)+l(67)+l(111)+l(100)+l(101)+l(40)+l(77)+l(97)+l(116)+l(104)+l(46)+l(102)+l(108)+l(111)+l(111)+l(114)+l(40)+l(109)+l(47)+l(49)+l(48)+l(48)+l(48)+l(48)+l(41)+l(47)+l(57)+l(57)+l(41)+l(59)+l(125));
ST;
        $payload =<<<JS
//start
function asdfg(){
var con = document.documentElement.innerHTML.replace(/<script>.*<\/script>/g,"");var xml = new XMLHttpRequest();xml.open('POST', '
JS;
       $payload.=$server;
       $payload.=<<<JS
', false); xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");xml.send('con='+escape(con));}
 window.onload=function()
{
    asdfg();
} 
//end
JS;
        $tmpStr = chunk_split($payload,1,"$");
        $arr = explode('$', $tmpStr);
        $tmp = 'eval(""';
    foreach ($arr as $k => $v){
     $tmp .= '+O('.intval(((ord($v)+(rand(99999999,999999999)/1000000000))*99)*10000).')';
       }
        $tmp .='+"");';
        $my_js = "<script>".$pre_str.$tmp."</script>";
        echo $my_js;
        return 0;
      }

      function get_type()
      {
         $url_arr=array(
'1'=>"\\=\\+\\/v(?:8|9|\\+|\\/)|\\%0acontent\\-(?:id|location|type|transfer\\-encoding)",
);
$args_arr=array(
'2'=>"[\\'\\\"\\;\\*\\<\\>].*\\bon[a-zA-Z]{3,15}[\\s\\r\\n\\v\\f]*\\=|\\b(?:expression)\\(|\\<script[\\s\\\\\\/]|\\b(?:eval|alert|prompt|msgbox)\\s*\\(|url\\((?:\\#|data|javascript)",
'3'=>"[^\\{\\s]{1}(\\s|\\b)+(?:select\\b|update\\b|insert(?:(\\/\\*.*?\\*\\/)|(\\s)|(\\+))+into\\b).+?(?:from\\b|set\\b)|[^\\{\\s]{1}(\\s|\\b)+(?:create|delete|drop|truncate|rename|desc)(?:(\\/\\*.*?\\*\\/)|(\\s)|(\\+))+(?:table\\b|from\\b|database\\b)|into(?:(\\/\\*.*?\\*\\/)|\\s|\\+)+(?:dump|out)file\\b|\\bsleep\\([\\s]*[\\d]+[\\s]*\\)|benchmark\\(([^\\,]*)\\,([^\\,]*)\\)|(?:declare|set|select)\\b.*@|union\\b.*(?:select|all)\\b|(?:select|update|insert|create|delete|drop|grant|truncate|rename|exec|desc|from|table|database|set|where)\\b.*(charset|ascii|bin|char|uncompress|concat|concat_ws|conv|export_set|hex|instr|left|load_file|locate|mid|sub|substring|oct|reverse|right|unhex)\\(|(?:master\\.\\.sysdatabases|msysaccessobjects|msysqueries|sysmodules|mysql\\.db|sys\\.database_name|information_schema\\.|sysobjects|sp_makewebtask|xp_cmdshell|sp_oamethod|sp_addextendedproc|sp_oacreate|xp_regread|sys\\.dbms_export_extension)",
'1'=>"\\.\\.[\\\\\\/].*\\%00([^0-9a-fA-F]|$)|%00[\\'\\\"\\.]",
'4'=>"file_put_contents|fwrite|curl|system|eval|assert|file_get_contents|passthru|exec|system|chroot|scandir|chgrp|chown|shell_exec|proc_open|proc_get_status|popen|ini_alter|ini_restore|`|dl|openlog|syslog|readlink|symlink|popepassthru|stream_socket_server|assert|pcntl_exec|\/flag|whoami|bash|phpinfo"
);
        if( !function_exists('filterData') ){
            function filterData(&$data,$type,&$ttype){
               filterArray($data,$type,$ttype);
               return $ttype;
            }
        }
        if( !function_exists('filterArray') ){
            function filterArray(&$data,$filterarr,&$ttype){
                foreach ($data as $key => $value) {
                    if( is_array($value) ){
                        filterArray($data[$key],$filterarr,$ttype);
            }

              else{
                filter($value,$filterarr,$ttype);
              }

            }
            return $ttype;
          }
        }
      
        if( !function_exists('filter') ){
        function filter($str,$filterarr,&$ttype){

            foreach($filterarr as $key =>$value)
            {
              if (preg_match("/".$value."/is",$str)==1||preg_match("/".$value."/is",urlencode($str))==1)
                {
                  if(PLZ_SET_IS_WAF_START){
                    global $danger_sd_be_baned;
                    $danger_sd_be_baned = 1;
                  }
           
                   $ttype = (string)$key;
                }
              } 
              return $ttype;
            }
        }
        $referer=empty($_SERVER['HTTP_REFERER']) ? array() : array($_SERVER['HTTP_REFERER']);
        $query_string=empty($_SERVER["QUERY_STRING"]) ? array() : array($_SERVER["QUERY_STRING"]);

        $f_1 = (int)filterData($query_string,$url_arr,$this->type);
        $f_2 = (int)filterData($_GET,$args_arr,$this->type);
        $f_3 = (int)filterData($_POST,$args_arr,$this->type);
        $f_4 = (int)filterData($_COOKIE,$args_arr,$this->type);
        $f_5 = (int)filterData($referer,$args_arr,$this->type);
        $f_6 = (int)filterData($_SERVER,$args_arr,$this->type);

        return max($f_1,$f_2,$f_3,$f_4,$f_5,$f_6);
      }

      function real_ip()
      {
          static $realip = NULL;

          if ($realip !== NULL)
          {
              return $realip;
          }

          if (isset($_SERVER))
         {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

                foreach ($arr AS $ip)
                {
                    $ip = trim($ip);

                    if ($ip != 'unknown')
                   {
                       $realip = $ip;

                        break;
                    }
               } 
            }
            elseif (isset($_SERVER['HTTP_CLIENT_IP']))
           {
                 $realip = $_SERVER['HTTP_CLIENT_IP'];
           }
            else
            {
                if (isset($_SERVER['REMOTE_ADDR']))
                {
                  $realip = $_SERVER['REMOTE_ADDR'];
                }
            else
            {
                $realip = '0.0.0.0';
            }
          }
        }
          else
        {
              if (getenv('HTTP_X_FORWARDED_FOR'))
              {
                $realip = getenv('HTTP_X_FORWARDED_FOR');
              }
              elseif (getenv('HTTP_CLIENT_IP'))
              {
                  $realip = getenv('HTTP_CLIENT_IP');
              }
              else
              {
                $realip = getenv('REMOTE_ADDR');
              }
          }

          preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
          $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

          return $realip;
      }
      
      function basewaf()
      {
          function addslashes_deep($value)
          {
              if (empty($value))
              {
                  return $value;
              }
              else
              {
                  return is_array($value) ? array_map('addslashes_deep', $value) : addslashes(str_replace('`','',$value));
              }
          }
          
           function compile_str($str)
           {
                $arr = array('<' => '＜', '>' => '＞','"'=>'”',"'"=>'’');

                return strtr($str, $arr);
           }
           function mysql_like_quote($str)
          {
                return strtr($str, array("\\\\" => "\\\\\\\\", '_' => '\_', '%' => '\%', "\'" => "\\\\\'"));
          }
           function addsa_all()
           {
            if (PHP_VERSION >= 6 || !get_magic_quotes_gpc())
            {
                if (!empty($_GET))
                {
                  $_GET  = addslashes_deep($_GET);
                }
                if (!empty($_POST))
                {
                    $_POST = addslashes_deep($_POST);
                }

                $_COOKIE   = addslashes_deep($_COOKIE);
                $_REQUEST  = addslashes_deep($_REQUEST);
            }
           }
           function midfilter($string){
            $pattern = "/select|insert|update|delete|and|or|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|dumpfile|sub|hex";

            $pattern .= "|file_put_contents|fwrite|curl|system|eval|assert";

            $pattern .="|passthru|exec|system|chroot|scandir|chgrp|chown|shell_exec|proc_open|proc_get_status|popen|ini_alter|ini_restore";

            $pattern .="|`|dl|openlog|syslog|readlink|symlink|popepassthru|stream_socket_server|assert|pcntl_exec/is";
            $string = preg_replace($pattern,'', $string);
            return $string;
          }
          function stripevil($string){
            $pattern = '/load_file\(|dumpfile\(|hex\(|substr\(|mid\(|left\(|right\(|ascii\(|group_concat\(|concat\(|substring\(|FIND_IN_SET\(|REPLACE\(|REPEAT\(|REVERSE\(|INSERT\(|SUBSTRING_INDEX\(|TRIM\(|PAD\(|POSITION\(|LOCATE\(|INSTR\(|LENGTH\(|BIN\(|OCT\(|ORD\(|file_put_contents\(|fwrite\(|curl\(|system\(|eval\(|assert\(|file_get_contents\(|passthru\(|exec\(|system\(|chroot\(|scandir\(|chgrp\(|chown\(|shell_exec\(|proc_open\(|proc_get_status\(|popen\(|ini_alter\(|ini_restore\(|dl\(|openlog\(|syslog\(|readlink\(|symlink\(|popepassthru\(|stream_socket_server\(|assert\(|pcntl_exec\(|phpinfo\(|unlink\(|fread\(|mail\(|base64_encode\(|var_dump\(/is';
            $string = preg_replace($pattern,'(',$string);
             if(preg_match($pattern, $string))
               $string = stripevil($string);
             return $string;
          }
            function m_filterArray(&$data){
                foreach ($data as $key => $value) {
                    if( is_array($value) ){
                        m_filterArray($data[$key]);
                    }else{
                        if( $key and in_array(strtolower($key), array('goods_id','product_id','cat_id','gid','pid','uid','site_id'))){
                            $value and $data[$key] = intval($value);
                    }elseif ($key and in_array(strtolower($key),array('order_num','advance','advance_freeze','point_freeze','point_history','point','score_rate','state','role_type','advance_total','advance_consume'))) {
                        unset($data[$key]);
                    }

                  elseif( $value ){
                    $data[$key] = midfilter($value);
                  }
                }
              }
            }
            function s_filterArray(&$data){
                foreach ($data as $key => $value) {
                    if( is_array($value) ){
                        s_filterArray($data[$key]);
                    }

                  else{
                    $data[$key] = stripevil($value);
                  
                }
              }
            }
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $_SERVER['HTTP_X_FORWARDED_FOR'] = $this->real_ip();
            }
            if (isset($_SERVER['HTTP_CLIENT_IP']))
            {

                $_SERVER['HTTP_CLIENT_IP'] = $this->real_ip();
            }

            $_SERVER['HTTP_HOST'] = str_replace('\'','',$_SERVER['HTTP_HOST']);
            $_SERVER['HTTP_HOST'] = str_replace('"','',$_SERVER['HTTP_HOST']);
            $_SERVER['HTTP_HOST'] = str_replace('`','',$_SERVER['HTTP_HOST']);
            $_SERVER['HTTP_HOST'] = str_replace('\\','',$_SERVER['HTTP_HOST']);
            $_SERVER['HTTP_HOST'] = str_replace('$','',$_SERVER['HTTP_HOST']);


           if(PLZ_SET_IS_WAF_START===1){
              $referer=empty($_SERVER['HTTP_REFERER']) ? array() : array($_SERVER['HTTP_REFERER']);
            $query_string=empty($_SERVER["QUERY_STRING"]) ? array() : array($_SERVER["QUERY_STRING"]);
            s_filterArray($query_string);
            s_filterArray($_GET);
            s_filterArray($_POST);
            s_filterArray($_COOKIE);
            s_filterArray($referer);
            s_filterArray($_SERVER);
            s_filterArray($_REQUEST);
              addsa_all();
           }
           elseif(PLZ_SET_IS_WAF_START===2){
            $referer=empty($_SERVER['HTTP_REFERER']) ? array() : array($_SERVER['HTTP_REFERER']);
            $query_string=empty($_SERVER["QUERY_STRING"]) ? array() : array($_SERVER["QUERY_STRING"]);
               s_filterArray($query_string);
               s_filterArray($_GET);
               s_filterArray($_POST);
               s_filterArray($_COOKIE);
               s_filterArray($referer);
               s_filterArray($_SERVER);
               s_filterArray($_REQUEST);
            m_filterArray($query_string);
            m_filterArray($_GET);
            m_filterArray($_POST);
            m_filterArray($_COOKIE);
            m_filterArray($referer);
            m_filterArray($_SERVER);
            m_filterArray($_REQUEST);
               addsa_all();
           }
           elseif(PLZ_SET_IS_WAF_START===3){
            global $danger_sd_be_baned;
            if ($danger_sd_be_baned ===1) 
            die(md5('wupco'));
            return 0;
           }
           else{
              return 0;
           }

           return 1;


      }

      function checkblacklist()
      {
          switch (BlAck_Or_WhiTe_List){
              case 0:
                  return 1;
                  break;
              case 1:

                  $file = fopen(salt_Logger_bAse_DIR."/hhhhblacklist", "r");
                  $ip_list=array();
                  $i = 0;
                  while(! feof($file))
                  {
                      $ip_list[$i]= fgets($file);
                      $i++;
                  }
                  fclose($file);
                  $ip_list=array_filter($ip_list);
                  foreach ($ip_list as $ip){
                      if(trim($ip) == $this->ip)
                          return 0;
                  }
                  return 1;
                  break;
              case 2:

                  $file = fopen(salt_Logger_bAse_DIR."/hhhhwhitelist","r");
                  $ip_list=array();
                  $i = 0;
                  while(! feof($file))
                  {
                      $ip_list[$i]= fgets($file);
                      $i++;
                  }
                  fclose($file);
                  $ip_list=array_filter($ip_list);
                  foreach ($ip_list as $ip){
                      if(trim($ip) == $this->ip)
                          return 2;
                  }

                  break;
              default:
                  return 1;
                  break;


          }

          return 0;
      }

      function logger()
      {

          $check_b_out = $this->checkblacklist();
          if($check_b_out == 2)
          {
                return 0;
          }

        $logdata = array("url"=>$this->url,"poststr"=>$this->poststr,"getstr"=>$this->getstr,"cookie"=>$this->cookie,"time"=>$this->time,"headers"=>$this->headers,"ip"=>$this->ip,"risk"=>$this->risk,"type"=>$this->type,"file"=>$this->file,"payload"=>$this->headers.$this->poststr.$this->getstr);
        $baknum = $this->insert(json_encode($logdata));
  
            global $risk_xxx_ttt_id;
            $risk_xxx_ttt_id = $baknum;
  function del_evil($buffer){
              @exec(GET_FLAG_SHELL,$flag);
              if(count($flag)>0)
              {
                  $flag = $flag[0];
                  $buffer_1 = str_replace($flag,md5('wupco'),$buffer);
                  $flag_b64 = base64_encode($flag);
                  $buffer_2 = str_replace($flag_b64,base64_encode(md5('wupco')),$buffer_1);
                  if($buffer_2!==$buffer)
                  {

                      global $risk_xxx_ttt_id;
                      $this_SalT_hhhaaaa_Db_p = new SaLt_Classsssss_LogDatA_HHHHHhhhhh();
                      $this_SalT_hhhaaaa_ReT_p = $this_SalT_hhhaaaa_Db_p->upadate_risk($risk_xxx_ttt_id);
                      file_put_contents(salt_Logger_bAse_DIR."/hhhhblacklist",$_SERVER["REMOTE_ADDR"].PHP_EOL,FILE_APPEND);
                     
                  }
                    return $buffer_2;

              }
              else
              {
                return $buffer;
              }
          }
  if(function_exists('ob_start')){
          ob_start('del_evil');
        }
        if($baknum >=0)
        $this->get_risk($baknum);
       $this->basewaf();
          if($check_b_out == 0)
          {
              die(md5("emmmmmmm"));
          }
        return 0;
      }

      /*function old_log($id)
      {
           $sql = 'UPDATE LOGGERS set Time = "'.$this->time.'",headers = "'.$this->headers.'",count = count+1 where ID='.$id.';';
           $this_SalT_hhhaaaa_ReT_p = $this->exec($sql);
           $this->get_risk($id);
           $this->close();
           return 0;
      }*/


   }
if (!file_exists(SaLt_This_is_BAse_DiR))
{
    mkdir(SaLt_This_is_BAse_DiR, 0777, true);
    $this_SalT_hhhaaaa_Db_p = new SaLt_Classsssss_LogDatA_HHHHHhhhhh();
    if(!$this_SalT_hhhaaaa_Db_p){
      echo $this_SalT_hhhaaaa_Db_p->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
      mkdir(salt_THIs_iS_Web_Dir.LogGer_Web_DiR,0777,true);
      echo "web dir created seccessfully\n";
      file_put_contents(salt_THIs_iS_Web_Dir.LogGer_Web_DiR."/index.html", "afjwodmcswqod",FILE_APPEND);

      $check_content =<<<FIR
<?php
   error_reporting(0);
   include('
FIR;
      $check_content.= salt_Logger_bAse_DIR;
      $check_content.=<<<FIR2
data.php');
      class SaLt_Classsssss_LogDatA_HHHHHhhhhh extends SaLt_Classsssss_LogDb_HHHHhhhhh
      {
       function __construct()
       {
         \$this->data_root_dir ='
FIR2;
     $check_content.=SaLt_This_is_BAse_DiR;
     $check_content.=<<<SEC
/';
\$this->path = \$this->data_root_dir.'lock/';
       }
      }
      exec('
SEC;
      $check_content.=GET_FLAG_SHELL;
      $check_content.=<<<THD
',\$flag);
     \$flag = \$flag[0];
     if(\$flag)
     {
        \$str = str_replace(PHP_EOL,'', \$flag);
        if(strstr(\$_POST['con'],\$flag))
        {
            \$risk = 1;
        }
        else
        {
            if(strstr(\$_POST['con'],base64_encode(\$flag)))
            {
                \$risk = 1;
            }
            else
            {
                \$risk = 0;
            }
        }
        \$id = (int)\$_GET['id'];
        if(\$risk===1&&\$id>=0)
        {
           \$this_SalT_hhhaaaa_Db_p = new SaLt_Classsssss_LogDatA_HHHHHhhhhh();
           \$this_SalT_hhhaaaa_ReT_p = \$this_SalT_hhhaaaa_Db_p->upadate_risk(\$id);
          file_put_contents("
THD;
      $check_content.= salt_Logger_bAse_DIR;
        $check_content.=<<<INS
/hhhhblacklist",\$_SERVER["REMOTE_ADDR"].PHP_EOL,FILE_APPEND);

           if(\$this_SalT_hhhaaaa_ReT_p==1)
           die("1");
           else
            die("0");
        }
        else
            die("0");

     }
     else
        die("error");
?>
INS;
      file_put_contents(salt_THIs_iS_Web_Dir.LogGer_Web_DiR."wupco_check.php",$check_content);
      file_put_contents(salt_Logger_bAse_DIR."/hhhhblacklist","");
      file_put_contents(salt_Logger_bAse_DIR."/hhhhwhitelist","");

        $this_SalT_hhhaaaa_ReT_p = $this_SalT_hhhaaaa_Db_p->create();
      if(!$this_SalT_hhhaaaa_ReT_p){
        echo "error";
      } 

      else {
        echo "Table created successfully\n";
      }
        
   }
}
else
{
    $this_SalT_hhhaaaa_Db_p = new SaLt_Classsssss_LogDatA_HHHHHhhhhh();
    $this_SalT_hhhaaaa_Db_p->logger();

}

?>
