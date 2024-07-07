<?php 
    if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],'dashboard.php')!==false)
    {
        $photo=isset($_GET['photo'])?$_GET['photo']:'';
        $target="photo/";
        $imgpath=$target.$photo;
        if(file_exists($imgpath) && is_readable($imgpath) )
        {
            $ext=pathinfo($imgpath,PATHINFO_EXTENSION);
            header("Content-Type:image/$ext");
            readfile($imgpath);
        }
        else
        {
            header("HTTP/1.0 404 Image Not Found");
        }
    }
    else
        header("HTTP/1.0 403 Access Forbidden");
?>