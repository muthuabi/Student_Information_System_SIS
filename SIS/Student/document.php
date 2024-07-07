<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MyStyles.css">
</head>
<style>
    #doc-upload
    {
        position: fixed;
        background-color: antiquewhite;
        padding:1rem;
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        box-shadow: 1px 2px 10px 5px lightgray;
        top:9.5rem;
        transform: scale(0);
      

    }
    .form-container
    {
        width: 100%;
        display: flex;
        justify-content: center;
  
    }
</style>
<?php
include_once("../Connection/Connection.php");
//session_start();
include_once("navbar.php"); 
if (isset($_SESSION['student'])) 
{
$student=$_SESSION['student']; 
?>
<body>
   
    <div class="container">
        <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" id="doc-upload">
            <div class="form-group">
                <label for="input-doc">Choose Document</label>
                <input type="file" name="Document_Name" required id="input-doc" class="form-control">
            </div>
            <div class="form-group">
                <label for="input-des">Description</label>
                <textarea name="Description" id="input-des" class='form-control'>

                </textarea>
            </div>
            <br>
            <button type="submit" name='DocUpload' class='btn btn-primary'>Upload</button>
            <br>
            <button type="button" name='cancel' id="doc_cancel" class='btn btn-default'>Cancel</button>
        </form>
        </div>
  
       
        <?php
            if(isset($_POST['DocUpload']))
            {
                
                $fname=$_FILES['Document_Name']['name'];
                $target="documents/$student/";
                $fsize=$_FILES['Document_Name']['size'];
                $des=$_POST['Description'];
                $ftype=pathinfo($fname,PATHINFO_EXTENSION);
               
                if(!file_exists($target))
                {
                    mkdir($target,777);
                    copy("./documents/index.php",$target."index.php");
                }
                $fpath=$target.$fname;
                if(move_uploaded_file($_FILES['Document_Name']['tmp_name'],$fpath))
                {
                    //echo "FileUpload Sucess ";
                    try{
                        $qry="INSERT INTO document(SID,Document_Name,Document_Path,Description,Document_Type,Document_Size) Values('$student','$fname','$fpath','$des','$ftype',$fsize)";
                        if(mysqli_query($conn,$qry))
                        {
                            echo "<script>alert('Upload Sucess');
                            window.location.href='document.php';
                            </script>";
                        }
                    }
                    catch(Exception $e)
                    {
                        echo $e->getMessage();
                    }
                }
                else
                {
                    echo "<script>alert('Upload Failed');</script>";
                }
            }
        ?>
        <div class="doclist">
            <br>
			
			<button type='button'  class='btn btn-secondary share_btn' name='share' >Share</button>
            <form>
                <button type="button" class="btn btn-primary" name="NewDoc" id="docup">+ New</button>
            </form>
			<button id="shareButton">Share</button>

<script>
document.addEventListener("DOMContentLoaded",(e)=>{
const share_btns = document.querySelectorAll(".share_btn");
share_btns.forEach(shareButton=>{
	
if (navigator.share) {
  // Web Share API is supported
  shareButton.addEventListener('click', async () => {
    try {
      await navigator.share({
        title:'Share',
        text: shareButton.name,
        url: shareButton.value
      });
      console.log('Shared successfully');
    } catch (error) {
      console.error('Error sharing:', error);
    }
  });
} else {
  // Fallback for browsers that do not support the Web Share API
  shareButton.style.display = 'none'; // Hide the share button if not supported
}
})
})
</script>

            <?php
    
               
            ?>
            <style>
                .docs
                {
                    padding:1rem;
                    box-shadow: 0px 1px 3px 3px gray;
                    margin:1rem;
                    border-radius: 5px;
                    word-wrap:break-word;
                }
            </style>
            <div class="documents">
          
                <?php
                $qry="SELECT * from document where SID='$student' Order by UploadOn DESC";
                if($res=mysqli_query($conn,$qry))
                {
                    while($result=mysqli_fetch_assoc($res))
                    {
                        $docname=$result['Document_Name'];
                        $name=pathinfo($docname,PATHINFO_FILENAME);
                        $doctype=$result['Document_Type'];
                        $sid=$result['SID'];
                        $uploadedon=$result['UploadOn'];
                        $uploadon=date('d M Y H:i A',strtotime($uploadedon));
                        $fdes=$result['Description'];
                        if(!$fdes)
                            $fdes="No Description";
                        $docpath=$result['Document_Path'];
                        $docsize=$result['Document_Size'];
                        $size=number_format($docsize/(1024),2);
                        $doid=$result['Document_ID'];
                        $docid=base64_encode($doid);
                        echo "<div class='docs'>
                            <h4>$name <em style='color:blue'> - $doctype </em></h4>
                            <em>$size Kb </em>
                            <br>
                            <b>$sid</b>
                            <p>$fdes</p>
                            <b>Uploaded On <br> <em>$uploadon</em></b>
                            
                            <form>
                            <br>
                                <button name='Delete' value='$docid' class='btn btn-danger' type='submit' > Delete</button>
                                <a href='docfetch.php?sid=$sid&doc=$docname'  class='btn btn-warning'>Download</a>
                                <button name='View' value='$docname' class='btn btn-success' type='submit'>View</button>
								<button type='button' id='$docid' value='$docpath' class='btn btn-light share_btn' name='$docname' >&vellip;</button>
                            </form>
                            </div>
                        ";

                    }
                }
                ?>
                <?php
                    if(isset($_GET['Delete']))
                    {
                        $deleteid=$_GET['Delete'];
                        $deleteid=base64_decode($deleteid);
                        $qry="DELETE FROM document where Document_ID=$deleteid";
                        if(mysqli_query($conn,$qry))
                        {
                         echo "<script>alert('Deleted Succesful')</script>";
                         echo "<script>window.location.href='document.php';</script>";
                        }
                    } 
                ?>
            </div>
        </div>
      <style>
        .view-container
        {
            width:100%;
            height:100vh;
            top:0;
            left:0;
            position:fixed;
            display:flex;
            justify-content: center;
            align-items: center;
            padding:1rem;
        }
        .viewer
        {
            height:100%;
            width:100%;
            position:relative;
        }
        .view-close
        {
            position:absolute;
            right:1rem;
            top:1rem;
            opacity:10%;
            transform:opacity 0.5s;
        }
        .view-close:hover
        {
            opacity:100%;
        }
        .viewer
        {
            background-color: black;
        }
        embed
        {
            object-fit: contain;
        }
        </style>
            <?php
                if(isset($_GET['View'])) 
                {
                    $sid=$student;
                    $doc=$_GET['View'];
                    $file="documents/".$sid."/".$doc;
                    echo "<div class='view-container'><div class='viewer' >";
                    if(file_exists($file))
                    {
                    $f=finfo_open(FILEINFO_MIME_TYPE);
                    $mime=finfo_file($f,$file);
          
                    echo "<a class='btn btn-dark view-close' title='close preview'  href='document.php'>X</a>";
                    echo "<embed src='$file' type='$mime'  width='100%' height='100%' /> ";
                    }
                    else
                    {
                        echo "Preview Unavailable";
                    }
                    echo " </div></div>
                    ";

                }
            ?>
       
    </div>
</body>
<?php
}
else
{
    echo "No Session";
}
?>

<script>
const rate=document.getElementById("docup");
document.addEventListener("DOMContentLoaded",(e)=>{
if(window.location.href.includes("NewDoc"))
{
    rate.click();
}
});
function docmodal()
{
   
    const modal=document.getElementById("doc-upload");
    const modalrated=document.getElementById("doc_submit");
    const modalcancel=document.getElementById("doc_cancel");
    rate.addEventListener("click",(e)=>{
        modal.style.transform="scale(1)";
    })
    modalcancel.addEventListener("click",(e)=>{
        modal.style.transform="scale(0)";
    })
}
docmodal();

    window.history.replaceState(null,null,window.location.href);
</script>
</html>