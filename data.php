<?php
function this_sAlt_add_PrE(&$value,$key,$pre)
{
    $value = "0_".$value."_".$pre;
          //echo $value;
              //echo "aa".$value;
 }
function this_sAlt_order_B_coUnt(&$value,$key,$pre)
{
  $val = explode("_", $value);
  $count = $val[2];
             //str_pad($str,30,".",STR_PAD_LEFT);
   $value = str_pad($count,32,"0",STR_PAD_LEFT)."_".$value."_".$pre;
}
function this_sAlt_order_B_iD(&$value,$key,$pre)
{
     $val = explode("_", $value);
      $id = $val[1];
      $value = str_pad($id,32,"0",STR_PAD_LEFT)."_".$value."_".$pre;
}
function this_sAlt_get_baSe_nAme(&$value,$key)
{
	$value = basename($value);
}
date_default_timezone_set('PRC');
Class SaLt_Classsssss_LogDb_HHHHhhhhh{
  public $data_root_dir;
  public $path=null;  
  private $fp = null;
  private $eAccelerator = false;
  private $salt;
	function __construct()
      {
         $this->eAccelerator = function_exists("eaccelerator_lock");
         $this->salt = "wupco123";
      }
      
     public function readfile($path,$type)
     {

     	  $file = fopen($this->data_root_dir.$path,"r");
     	  if(!$file)
     		   return 0;

		    if (flock($file,1))
  		  {
  			   switch ($type) {

  				    case 'JSONA':
 					      $filearr = array();
  					     while(!feof($file))
  					     {
                    $line = fgets($file);
                    if($line === false)
                        break;
                     else
  						          array_push($filearr,$line);
  					     }
  					     $filestr = json_encode($filearr);
  					     break;

  				    case 'JSONCSV':
  					     $filearr = array();
  					     while(! feof($file))
  					     {
                    $line = fgetcsv($file,0,chr(0));
                   if($line === false)
                      break;
                   else
  						      array_push($filearr,$line);
				        	}
					       $filestr = json_encode($filearr);
					       break;

  				    default:
                  //echo $this->data_root_dir.$path;
  					       $filestr = fread($file,filesize($this->data_root_dir.$path));
  					       break;
  			       }
  		
  			     flock($file,3);
             fclose($file);
  			     return $filestr;
  		    }
		      else
  		    {
             fclose($file);
  			     return -1;
  		    }

		      

      }

      public function writefile($path,$action,$type,$content)
      {
        $file = fopen($this->data_root_dir.$path,$action);
        if(!$file)
           return 0;

        if (flock($file,2))
        {
          switch ($type) {
            case 'CSV':
              fputcsv($file,$content,chr(0));
              //var_dump($content);
              break;
            
            default:
              fwrite($file,$content);
              break;
          }
          flock($file,3);
          fclose($file);
        }
        else
        {
          fclose($file);
          return -1;
        }


      }


      private function getindex()
      {
        if($i_data = $this->readfile('dataindex.exe','JSONCSV'))
        {

          $i_data = json_decode($i_data);
          $alldata = array();
          foreach($i_data as $line)
          {
            //var_dump($line);
            $data = array("IP"=>$line[0],"DIR"=>$line[1],"LAST_TIME"=>$line[2],"IS_DANGER"=>$line[3],"LAST_ID"=>$line[4]);
            //array_push($alldata,$data);
            $alldata[$line[0]] = $data;
          }
          return json_encode($alldata);
        }
        else
        {
          return 0;
        }
      }

    private function writeindex($indexjson)
    {
        $index = json_decode($indexjson);
        $this->writefile('dataindex.exe','w','','');
        foreach($index as $ip=>$data)
        {
          $data = $data;
          $arr = array($data->IP,$data->DIR,$data->LAST_TIME,$data->IS_DANGER,$data->LAST_ID);
         // var_dump($arr);
          //$a->writefile('dataindex','a','CSV',$b);
          $this->writefile('dataindex.exe','a','CSV',$arr);
        }
        //var_dump($this->getindex());
        return 0;
    }
     
     private function lock($name)
     {
        if(!$this->eAccelerator)  
        {
            $this->fp = fopen($this->path.$name, 'w+');
            if($this->fp === false)  
            {  
                return false;  
            }  
            return flock($this->fp, LOCK_EX);
        }
        else
        {  
            return eaccelerator_lock($name);
        }

     }

     private function unlock($name)
     {
        if(!$this->eAccelerator)
        {  
            if($this->fp !== false)  
            {  
                flock($this->fp, LOCK_UN);  
                clearstatcache();  
            }   
            fclose($this->fp);  
        }
      else
        {  
           return eaccelerator_unlock($name);  
        }
     }

     public function create()
     {
      if (!file_exists($this->data_root_dir))
      {
          echo "Please first Create data-dir";
          return -1;
      }
      else
      {
        file_put_contents($this->data_root_dir."dataindex.exe","");
        file_put_contents($this->data_root_dir."id.jpg","-1");
        mkdir($this->data_root_dir."lock/", 0777, true);
        return 1;
      }
        
     }

     public function insert($data)
     {
        $this->lock('index');
        $index = json_decode($this->getindex(),true);
        $data = json_decode($data,true);
        //var_dump($index);
        //var_dump($this->getindex());
        $lastid = (int)($this->readfile('id.jpg',''));
        //echo $lastid;
        
        if(!array_key_exists($data['ip'],(array)$index))
        {
            $ipdir = md5($data['ip'].$this->salt.((string)time()));
            mkdir($this->data_root_dir.$ipdir."/", 0777, true);
            mkdir($this->data_root_dir.$ipdir."/payload/", 0777, true);
            mkdir($this->data_root_dir.$ipdir."/danger/", 0777, true);
            $dir = $ipdir;
            
            $lasttime = (string)time();
            $is_danger = $data['risk'];
            @$index[$data['ip']]['DIR']= $dir;
            @$index[$data['ip']]['LAST_ID'] = 0;
            @$index[$data['ip']]['LAST_TIME'] = $lasttime;
            @$index[$data['ip']]['IS_DANGER'] = $is_danger;
            @$index[$data['ip']]['IP'] = $data['ip'];
        }
        else
        {
            $dir = $index[$data['ip']]['DIR'];
            $lasttime = $index[$data['ip']]['LAST_TIME'];
            $is_danger = $index[$data['ip']]['IS_DANGER'];
        }
        
    
        if(file_exists($this->data_root_dir.$dir."/payload/".bin2hex($data['file'])."/".md5($data['payload'])))
        {      
          $filename = $this->readfile($dir."/payload/".bin2hex($data['file'])."/".md5($data['payload']),'');
          if($filename)
          {
              $file = $this->readfile($dir."/".$filename,'JSONCSV');
              if($file)
              {
                  $file = json_decode($file);
                  foreach($file as $line)
                  {
                    $id = $line[0];
                    $risk = $line[8];
                    $count = $line[11]+1;
                    $f_link = $line[10];
                  }
                  unlink($this->data_root_dir.$dir."/".$filename);
                  $id = explode("_", $filename);
                  $id = $id[1];
                  $newname = (string)time()."_".(string)$id."_".(string)$count;
                  $wd = array($id,$data['url'],$data['poststr'],$data['getstr'],$data['cookie'],$data['time'],$data['headers'],$data['ip'],$risk,$data['type'],$f_link,$count);
                  $this->writefile($dir."/".$newname,'w','CSV',$wd);
                  $this->writefile($dir."/payload/".bin2hex($data['file'])."/".md5($data['payload']),'w','',$newname);
                  if((int)$risk == 1)
                  {
                    unlink($this->data_root_dir.$dir."/danger/".$filename);
                    $this->writefile($dir."/danger/".$newname,'w','','');
                  }
                  $baknum = -1;

              }
              else
                $baknum = -2;

          }
          else
            $baknum = -3;
          //$payloads = $this->readfile($this->data_root_dir.$dir."/payload/".$data['file']),'JSONA');
          
        }
        else
        {
          
          if(!file_exists($this->data_root_dir.$dir."/payload/".bin2hex($data['file'])."/"))
            mkdir($this->data_root_dir.$dir."/payload/".bin2hex($data['file'])."/", 0777, true);
          $newid = ((int)$lastid) + 1;
          //echo $newid;
          $newfile = (string)time() . "_" . (string)$newid."_0";
          $f_link = $this->data_root_dir.$dir."/payload/".bin2hex($data['file'])."/".md5($data['payload']);
          $wd = array($newid,$data['url'],$data['poststr'],$data['getstr'],$data['cookie'],$data['time'],$data['headers'],$data['ip'],$data['risk'],$data['type'],$f_link,0);
          $this->writefile($dir."/".$newfile,'w','CSV',$wd);
          $this->writefile($dir."/payload/".bin2hex($data['file'])."/".md5($data['payload']),'w','',$newfile);
          $this->writefile('id.jpg','w','',(string)$newid);
          @$index[$data['ip']]['LAST_ID'] = (string)$newid;

         $baknum = $newid;
          //$index[$data['ip']]['LAST_TIME'] = (string)time();
        }
        $this->writeindex(json_encode($index));
        //var_dump($index);
        //echo $this->getindex();
        $this->unlock('index');
        return $baknum;

     }

     public function ip_list()
     {
        $index = json_decode($this->getindex());
        if(is_array($index))
        {
          if(size($index)==0)
            return 0;
          else
            return -1;
        }
        else
        {
          $ip_list = json_encode(array_keys(get_object_vars($index)));
          return $ip_list;
        }
     }
     public function select_by_ip($ip,$limit,$desc,$start,$getnum,$time)
     {
         $index = json_decode($this->getindex());
        //print_r( $index;
        if(is_array($index))
        {
          if(sizeof($index)==0)
            return 0;
          else
            return -1;
        }
        else
        {
          //$dir_list = array();
          $index = json_decode(json_encode($index),true);
          $dir = $index[$ip]['DIR'];
           if($time===0){
            $filenames = scandir($this->data_root_dir.$dir);
		array_splice($filenames, 0, 2);
             	array_splice($filenames, -2, 2);
	     }
            else{
                   $filenames = glob($this->data_root_dir.$dir.'/'.$time.'*');
                 array_walk($filenames,"this_sAlt_get_baSe_nAme");

	   }
          if($getnum)
          {
            return sizeof($filenames);
          }

           if($limit == -1)
          {
            $limit = sizeof($filenames);
          }
          if(sizeof($filenames)<$limit+$start)
          {
            $limit = sizeof($filenames) -$start;
          }
          if($desc === 1)
          
            rsort($filenames);
          
          else
            sort($filenames);
          //var_dump($filenames);
           $mess = array();

            for($i=$start;$i<$limit+$start;$i++)
           {
              
              $c = json_decode($this->readfile($dir."/".$filenames[$i],"JSONCSV"));
               array_push($mess,$c);
           }
            return json_encode($mess);

        }
     }
     private function dir_list()
     {
        $index = json_decode($this->getindex());
        //print_r( $index);
        if(is_array($index))
        {
          if(sizeof($index)==0)
            return 0;
          else
            return -1;
        }
        else
        {
          $dir_list = array();
          foreach($index as $ip=>$data)
          {
            array_push($dir_list,$data->DIR);
          }
          return json_encode($dir_list);
        }
     }
     
   
 
     public function select_list($order,$limit,$jback,$desc,$getnum,$start,$time)
     {
        $dir_list = $this->dir_list();
        //print $dir_list;
        if($dir_list)
        {
          $dir_list = json_decode($dir_list);
          $filename = array();
          
          //var_dump($dir_list);
          foreach($dir_list as $dir)
          {
            //echo $this->data_root_dir;
	    if($time===0){
            $filenames = scandir($this->data_root_dir.$dir);
		array_splice($filenames, 0, 2);
             array_splice($filenames, -2, 2);
	     }
               else{
                   $filenames = glob($this->data_root_dir.$dir.'/'.$time.'*');
                 array_walk($filenames,"this_sAlt_get_baSe_nAme");
		

	   }
            //echo $this->data_root_dir.$dir."<br>";
            //echo $dir;
            //var_dump($filenames);
            //$key = array_search('.', $filenames);
            //if ($key !== false)
             
             switch ($order) {
               case 'count':
                 array_walk($filenames,"this_sAlt_order_B_coUnt",$dir);
                 break;
               case 'id':
                  array_walk($filenames,"this_sAlt_order_B_iD",$dir);
                  break;
               default:
                 array_walk($filenames,"this_sAlt_add_PrE",$dir);
                 break;
             }

                 

             //array_push($filename,$filenames);
             $filename = array_merge($filename,$filenames);
            //$key = array_search('.', $filenames);

          }
          if($getnum)
          {
            return sizeof($filename);
          }
          if($limit == -1)
          {
            $limit = sizeof($filename);
          }
          if(sizeof($filename)<$limit+$start)
          {
            $limit = sizeof($filename) - $start;
          }
          if($desc === 1)
          
            rsort($filename);
          
          else
            sort($filename);
          //var_dump($filename);
          if($jback === 'content')
          {

            $mess = array();
           //var_dump($filename);
            //print $limit;
            //print sizeof($filename);
            //
            //echo $start;
            for($i=$start;$i<$limit+$start;$i++)
           {
            //echo $filename[$i];
               $tmp = explode("_",$filename[$i]);
               //var_dump($tmp);
              $d = $tmp[4];
              $f = $tmp[1]."_".$tmp[2]."_".$tmp[3];
              $c = json_decode($this->readfile($d."/".$f,"JSONCSV"));
               array_push($mess,$c);
           }
            return json_encode($mess);
          }
          elseif($jback === 'count_suff')
          {
            return json_encode($filename);
          }
          else
          {

            $limitfile = array();
            for($i=$start;$i<$limit;$i++)
           {
              $tmp = explode("_",$filename[$i]);
              $d = $tmp[4];
              $f = $tmp[1]."_".$tmp[2]."_".$tmp[3];
              array_push($limitfile,$d."/".$f);
           }
            return json_encode($limitfile);
          }
          
        }
        else
        {
          return -2;
        }
        //echo $this->dir_list();
     }



     public function get_num($mod,$group,$time)
     {
	$time = $time;
        switch ($mod) {
          case 'all':
            return $this->select_list('',-1,'',1,1,0,$time);
            break;
          case 'risk':
            return $this->prob_payload(-1,1,1,0);
            break;
          case 'more':
             return $this->prob_payload(-1,1,0,0);
             break;
          case 'ip':
             return $this->select_by_ip($group,-1,1,0,1,$time);
          default:
            return 0;
            break;
        }

     }

     public function select_by_id($id)
     {
      //print $id;
        $bak = $this->select_list('id',$id+1,'1',0,0,0,0);
       // print $bak;
        if($bak)
        {
          $bak = json_decode($bak,true);
          if(sizeof($bak)>0)
          {
            return $bak[sizeof($bak)-1];         
            //var_dump($bak);
          }
          else
           return -1;
        }
        else
          return 0;

     }



     public function danger_list()
     {
        $dir_list = $this->dir_list();
        if($dir_list)
        {
          $dir_list = json_decode($dir_list);
          $filename = array();
          foreach($dir_list as $dir)
          {
            $filenames = scandir($this->data_root_dir.$dir.'/danger');
            array_splice($filenames, 0, 2);
            array_walk($filenames,"this_sAlt_order_B_coUnt",$dir);
            $filename = array_merge($filename,$filenames);
          }
          rsort($filename);
          return json_encode($filename);
        }
        else
          return -1;
     }

     public function prob_payload($limit,$getnum,$onlydanger,$start)
     {
        $danger = $this->danger_list();
        if($danger)
        {
          $danger = json_decode($danger,true);
          if($onlydanger)
            $count = json_encode(array());
          else
          $count = $this->select_list('count',-1,'count_suff',1,0,0,0);
          if($count)
          {
            $count = json_decode($count,true);
            $all = array_merge($danger,$count);
            $alllist = array(); 
            $alllist = array_values(array_unique($all));
            if($getnum)
              return sizeof($alllist);
            if(sizeof($alllist)<$limit+$start)
             {
               $limit = sizeof($alllist) - $start;
              }
              $mess = array();

                for($i=$start;$i<$limit+$start;$i++)
               {
                  $tmp = explode("_",$alllist[$i]);
                   $d = $tmp[4];
                  $f = $tmp[1]."_".$tmp[2]."_".$tmp[3];
                   $c = json_decode($this->readfile($d."/".$f,"JSONCSV"),true);
                  array_push($mess,$c);
                }
             // $bjson = array("allnum"=>$num,$mess);
              return json_encode($mess);

          }
          else
            return -1;
         

        }
        else
          return -2;
     }

     public function get_content_by_id($id)
     {
         $filename = $this->select_by_id($id);
         if($filename)
         {
             $content = $this->readfile($filename,'JSONCSV');
             if($content)
             {
                 return $content;

             }
             else
             {
                 return 0;
             }
         }
         else
             return -1;
     }

    public function del_by_id($id)
    {
        $filename = $this->select_by_id($id);
        if($filename)
        {
            $content = $this->readfile($filename,'JSONCSV');
            if($content)
            {
                $content = json_decode($content, true);
                $f_link = $content[0][10];
                if($f_link)
                {
                    $f_link = explode(' ', $f_link);
                    foreach ($f_link as $file_l)
                    {
                        if(file_exists($file_l)){
                            file_put_contents($this->data_root_dir.'../tarlog.sh','tar -rvf '.$this->data_root_dir.'/logbak.tar.bz2 '.$file_l."\n");
                            file_put_contents($this->data_root_dir.'../tarlog.sh','rm '.$file_l."\n",FILE_APPEND);
                            file_put_contents($this->data_root_dir.'../tarlog.sh','chmod 777 '.$this->data_root_dir.'/logbak.tar.bz2',FILE_APPEND);


                        }

                    }
                    if(file_exists($this->data_root_dir.$filename)) {
                        file_put_contents($this->data_root_dir.'../tarlog.sh','tar -rvf '.$this->data_root_dir.'/logbak.tar.bz2 '.$this->data_root_dir.$filename."\n",FILE_APPEND);
                        file_put_contents($this->data_root_dir.'../tarlog.sh','rm '.$this->data_root_dir.$filename."\n",FILE_APPEND);
                        file_put_contents($this->data_root_dir.'../tarlog.sh','chmod 777 '.$this->data_root_dir.'/logbak.tar.bz2',FILE_APPEND);
                        system('bash '.$this->data_root_dir.'../tarlog.sh');


                    }
                    return 1;
                }
                else
                {
                    if(file_exists($this->data_root_dir.$filename)){
                        file_put_contents($this->data_root_dir.'../tarlog.sh','tar -rvf '.$this->data_root_dir.'/logbak.tar.bz2 '.$this->data_root_dir.$filename."\n");
                        file_put_contents($this->data_root_dir.'../tarlog.sh','rm '.$this->data_root_dir.$filename."\n",FILE_APPEND);
                        file_put_contents($this->data_root_dir.'../tarlog.sh','chmod 777 '.$this->data_root_dir.'/logbak.tar.bz2',FILE_APPEND);
                        system('bash '.$this->data_root_dir.'../tarlog.sh');

                    }
                    return 1;
                }


            }
            else
            {
                return 0;
            }

        }
        else
            return -1;
    }

     public function upadate_risk($id)
     {
        $filename = $this->select_by_id($id);
        //echo  $filename;
	echo "\n".$id."\n";
        if($filename)
        {
           $content = $this->readfile($filename,'JSONCSV');
           if($content)
           {
              $content = json_decode($content,true);
              $content[0][8] = 1;
              $risk_ip = $content[0][7];
              $this->writefile($filename,'w',"CSV",$content[0]);
              $index = $this->getindex();
              if($index)
              {
                $tmp = explode("/",$filename);
                $index = json_decode($index,true);
                //var_dump($index);
                $index[$risk_ip]['IS_DANGER'] = 1;
                $dir = $index[$risk_ip]['DIR'];
                $this->writeindex(json_encode($index));
                $content[0][11] = $content[0][11].' '.$this->data_root_dir.$dir."/danger/".$tmp[1];
                $this->writefile($filename,'w',"CSV",$content[0]);
                $this->writefile($dir."/danger/".$tmp[1],'w','','');
                return 1;
              }
              else
              {
                return $index;
              }
           }
           else
           {
             return $content;
           }
        }
        else
        {
          //echo "sss";
          return 0;
        }
     }



}

//$a = new SaLt_Classsssss_LogDb_HHHHhhhhh();

//$a->create();
// $wd = array($data['url'],$data['poststr'],$data['getstr'],$data['cookie'],$data['time'],$data['headers'],$data['ip'],$risk,$data['type'],$count);
//$payload = $_GET['id'];
//$b = array("url"=>"www.baidu.com","poststr"=>"t=post","getstr"=>"t=get","cookie"=>"t=cookie","time"=>"2014-2-10","headers"=>"asdasd\ndasdsdas","ip"=>"127.0.0.8","risk"=>"0","type"=>"0","file"=>"index.php","payload"=>$payload);
//print $a->('id',5,'content',0);
//$a->insert(json_encode($b));
//echo $a->upadate_risk(3);
//var_dump($a->readfile('7d968c105afd8c49b52ef42266675f2d/1494994152_5_0','JSONCSV'));
?>
