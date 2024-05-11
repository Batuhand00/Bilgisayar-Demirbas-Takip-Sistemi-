<?php
function ileri($url,$time=0)
{
    if($time !=0)
    {
        header("Refresh:$time;url=$url");
    }
    else 
    {
        header("Location:$url");
    }
}

function geri($time =0)
{
    $url =$_SERVER["HTTP_REFERER"];
    if($time !=0)
    {
        header("Refresh:$time;url=$url");
    }
    else 
    {
        header("Location:$url");
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
    
