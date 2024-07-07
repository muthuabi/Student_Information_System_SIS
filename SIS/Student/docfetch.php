<?php
if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],'document.php')!==false)
    echo "";
else
{
    header("HTTP/1.0 403 Access Forbidden");
    die("");
}

if (isset($_GET['doc']) && isset($_GET['sid']))
 {
    $doc  = $_GET['doc'];
    $sid  = $_GET['sid'];
    $file = "documents/" . $sid . "/" . $doc;
   //echo $file;
    if (file_exists($file)) {
        // Set headers
        $f=finfo_open(FILEINFO_MIME_TYPE);
        $mime=finfo_file($f,$file);
        header('Content-Description: File Transfer');
        header("Content-Type: $mime"); // Set the appropriate content type
        header('Content-Disposition: attachment; filename='. basename($file));
        header('Content-Length: '. filesize($file));
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Expires: 0');
        // Read the file and output its contents
        readfile($file);
        exit;
    } else {
     header("HTTP/1.0 404 File Not Found");
    }
} else {
    header("HTTP/1.0 403 Access Forbidden");
    http_response_code(403);
}
