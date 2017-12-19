<?php

header("Content-Type: text/html;charset=utf-8");
session_start();
function getrandhash()
{
    return md5((string)(rand()).md5((string)(time())));
}
function _m_khashdir($dir)
{
    $hashdir = $dir.getrandhash().'/';
    if (!file_exists($hashdir)) {

        mkdir($hashdir, 0777, true);
        echo "make dir ".$hashdir." ok \n";
        return $hashdir;
    }
    else
        _m_kdir($hashdir);

}
function rep_weblogpro($content)
{
    $content = str_replace('@@@@@@@@',$_SESSION['webdir'],$content);
    $content = str_replace('########',$_SESSION['databasedir'],$content);
    $content = str_replace('!!!!!!!!',$_SESSION['filesalt'],$content);
    $content = str_replace('********',$_SESSION['prvkey'],$content);
    $content = str_replace('%%%%%%%%',$_SESSION['getflagshell'],$content);
    $content = str_replace('^^^^^^^^',$_SESSION['webcomdir'],$content);
    return $content;
}

function rep_manage($content)
{
    $content = str_replace('********',$_SESSION['databasedir'].md5($_SESSION['prvkey'].$_SESSION['filesalt']).'/' ,$content);
    $content = str_replace('!!!!!!!!', $_SESSION['username'], $content);
    $content = str_replace('@@@@@@@@', $_SESSION['passwd'], $content);
    $content = str_replace('########', $_SESSION['databasedir'].'data.php', $content);
    return $content;
}

if(!isset($_SESSION['step'])) {
    echo "<form action=\"\" method=\"POST\">
    输入数据存储路径: <input name=\"datadir\" value='/tmp/'></br>
    输入web根目录: <input name=\"webdir\" value = '/var/www/html/'></br>
    <input type=\"submit\">
</form>";
    if(isset($_POST['datadir'])&& isset($_POST['webdir']))
    {
        $_SESSION['datadir'] = $_POST['datadir'];
        $_SESSION['webdir'] = $_POST['webdir'];
        $_SESSION['step'] = 1;
        echo "<script>location.href = location.href;</script>";

    }

}
elseif($_SESSION['step'] === 1)
{
    $data_base_dir =  _m_khashdir($_SESSION['datadir']);
    $_SESSION['databasedir'] = $data_base_dir;
    $web_base_dir = _m_khashdir($_SESSION['webdir']);
    $web_com_dir = str_replace($_SESSION['webdir'],'',$web_base_dir);
    $_SESSION['webcomdir'] = $web_com_dir;
    $_SESSION['webbasedir']= $web_base_dir;
    $_SESSION['step'] = 2;
    echo "<script>location.href = location.href;</script>";
}
elseif($_SESSION['step'] === 2)
{
    echo "<form action='' method = 'POST'>
            输入可以获取flag的bash命令: <input name = 'getflagshell' value = 'cat /flag'><br>
            输入管理账号: <input name = 'username'><br>
            输入管理密码: <input name = 'passwd'><br>
            <input type = 'submit'>
          </form>
     ";
    if(isset($_POST['username'])&&isset($_POST['passwd'])&&isset($_POST['getflagshell']))
    {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['passwd'] = $_POST['passwd'];
        $_SESSION['getflagshell'] = $_POST['getflagshell'];
        $_SESSION['filesalt'] = getrandhash();
        $_SESSION['prvkey'] = getrandhash();
        $_SESSION['step'] = 3;
        echo "<script>location.href = location.href;</script>";
    }
}
elseif($_SESSION['step'] === 3)
{
    $weblogpro = file_get_contents('weblogpro.php');
    $weblogpro = rep_weblogpro($weblogpro);
    file_put_contents($_SESSION['databasedir'].'weblogpro.php',$weblogpro);
    echo "weblogpro.php create ok \n";
    system('mv data.php '.$_SESSION['databasedir'].'data.php');
    system('mv temp.php '.$_SESSION['databasedir'].'temp.php');
    system('mv  wupco_static '.$_SESSION['webbasedir'].'/wupco_static');
    $_SESSION['managedir'] = $_SESSION['webbasedir'].getrandhash().'/';
    mkdir($_SESSION['managedir'], 0777, true);
    $manage = file_get_contents('managelog.php');
    $manage = rep_manage($manage);
    file_put_contents($_SESSION['managedir'].'managelog.php',$manage);
    $_SESSION['step'] = 4;
    echo "file moved ok \n";
    echo "<script>location.href = location.href;</script>";
}
elseif ($_SESSION['step'] === 4)
{
    require_once($_SESSION['databasedir'].'weblogpro.php');
    $_SESSION['step'] = 5;
    $killer = "while true\ndo\n ps aux | grep 'www-data'|grep -v $$|awk '{print $2}'|xargs kill -9\nsleep 0.1\ndone";
    $killername = $_SESSION['databasedir'].getrandhash().'.sh';
    file_put_contents($killername,$killer);
    $killerphp = "<?php\nset_time_limit(1);\nsystem('nohup sh ".$killername." &');\n?>";
    $killerphpname = $_SESSION['managedir'].'killer.php';
    file_put_contents($killerphpname,$killerphp);
    file_put_contents($_SESSION['databasedir'].'tarlog.sh',"");
    system('chmod -R 555 '.$_SESSION['webbasedir']);
    echo "<script>window.location.reload();</script>";
}
elseif ($_SESSION['step'] === 5)
{
    require_once($_SESSION['databasedir'].'weblogpro.php');
    $_SESSION['step'] = 6;
    echo ("all ok! please include ".$_SESSION['databasedir']."weblogpro.php <br> managepath : ".$_SESSION['managedir'].'managelog.php');
    session_unset();
    session_destroy();
    system('sh rm_me.sh');
    exit();
}

