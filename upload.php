<?php
echo '<pre>';
$img = $_FILES['img'];

$name=$_POST['name'];
if(!empty($img))
{
    $img_desc = reArrayFiles($img);
    print_r($img_desc);

    foreach($img_desc as $val)
    {
        $newname = date('YmdHis',time()).mt_rand().'.jpg';
        echo './odm_project/'.$name."/images/".$newname;
        move_uploaded_file($val['tmp_name'],'./odm_project/'.$name."/images/".$newname);
    }
}

function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);

    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}
echo "<script>window.location.href='./index.php'</script>";
