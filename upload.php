<?
echo
'
<table width="600">
<form action="upload.php" method="post" enctype="multipart/form-data">

<tr>
<td width="80%"><input type="file" name="file" id="file" /></td>
</tr>

<tr>
<td><input type="submit" name="submit" /></td>
</tr>

</form>
</table>
';

if ( isset($_POST["submit"]) ) {

   if ( isset($_FILES["file"])) {

            //if there was an error uploading the file
        if ($_FILES["file"]["error"] > 0) {
            //echo "Return Code: " . $_FILES["file"]["error"] . "<br />";

        }
        else {
            if (file_exists("upload/" . $_FILES["file"]["name"])) {
            //echo $_FILES["file"]["name"] . " already exists. ";
             }
             else {
            $storagename = $_FILES["file"]["name"];
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $storagename);
            
            }
        }
     } else {
             echo "No file selected <br />";
     }
}

$file = fopen("upload/" . $_FILES["file"]["name"], 'r');
$p=0;
while (($line = fgetcsv($file)) !== FALSE) {
   $p++;
   //print_r($line);
   $rh = explode(".",$line[0]);    
   $myfile = fopen("upload/".$p.".".$rh[1]."", 'w') or die("Unable to open file!");
   $txt = "Mickey Mouse\n";
   fwrite($myfile, $line[1]);
   fclose($myfile);
   echo 'Файл '.$p.'.'.$rh[1].' готов'.'</br>';
   
}

fclose($file);

?>