<?php
function getLastNews(){
    $SQL = new SqlClass();
    $SQL->SELECT("SELECT * FROM nouvelle WHERE DateParution <= ".time()." AND Compagnie='SDS' ORDER BY DateParution DESC LIMIT 0,1");
        $Rep = $SQL->FetchArray();
    $Output = "<b>".$Rep['Titre']."</b><br>".$Rep['Texte'];
    Return $Output;

}

function getLastTruc(){
    $SQL = new SqlClass();
    $SQL->SELECT("SELECT * FROM truc ORDER BY IDTruc DESC LIMIT 0,1");
    return $SQL->FetchArray();
    
}

function getpicfolders(){
    $handle=opendir("./photo/");
    $fileDir = array();
    while (($currentFile = readdir($handle))!==false) {
        if ($currentFile != "." and $currentFile != ".."){
            if (is_dir("./photo/".$currentFile."/")){
                $fileDir[] = array(filemtime("./photo/".$currentFile."/"),$currentFile);
            }
        }
    }

    foreach($fileDir as $key=>$value){
       $time[$key] = $value[0];
    }
    array_multisort($time,SORT_DESC,$fileDir);
    return $fileDir;
}

function getpicinfo($folder){

    $info = array();
    $nbline=1;
    foreach(file("./photo/".$folder."/info.inc") as $line){
        if($nbline==1)
            $info['Titre'] = $line;
        if($nbline==2)
            $info['Description'] = $line;

        $nbline++;

    }
    return $info;

}

function getpic($folder,$page){
$InitialPath = "./photo/".$folder."/";
    $handle=opendir($InitialPath );
    $fileDir = array();
    while (($currentFile = readdir($handle))!==false) {
        if ($currentFile != "." and $currentFile != ".." and $currentFile != "info.inc"){
                $fileDir[] = array(filemtime($InitialPath.$currentFile),$currentFile);
       }
    }

    foreach($fileDir as $key=>$value){
       $time[$key] = $value[0];
    }
    
    array_multisort($time,SORT_DESC,$fileDir);


    $NbPic = max(array_keys($fileDir))+1;
    $nbMaxPage = ceil(($NbPic)/12);
    if($page>$nbMaxPage){
        $page=$nbMaxPage;
    }
    $pic = array();
    for ($i = $page*12; $i < min($NbPic,($page+1)*12); $i++) {
        $pic[] = $fileDir[$i][1];
    }
    return $pic;

}

function getNBPicPages($folder){
    $InitialPath = "./photo/".$folder."/";
    $handle=opendir($InitialPath );
    $fileDir = array();
    while (($currentFile = readdir($handle))!==false) {
        if ($currentFile != "." and $currentFile != ".." and $currentFile != "info.inc"){
                $fileDir[] = array(filemtime($InitialPath.$currentFile),$currentFile);
       }
    }

    foreach($fileDir as $key=>$value){
       $time[$key] = $value[0];
    }

    array_multisort($time,SORT_DESC,$fileDir);


    return intval(ceil(max(array_keys($fileDir))+1)/12);
}

function get_variable($nom){
    $SQL = new SqlClass();
    $SQL->SELECT("SELECT * FROM variable WHERE Name = '".$nom."'");
    $Var = $SQL->FetchArray();
    
    if($Var['ValueType']=="Boolean"){
        if($Var['Value']=="TRUE")
            return TRUE;
        if($Var['Value']=="FALSE")
            return FALSE;
    }
    
    return null;
}


function get_info($Table,$ID){
	$SQL = new sqlclass;
	$Table =  strtolower($Table);
	$Req = "SELECT * FROM `".$Table."` WHERE ID".ucfirst($Table)." = ".$ID;
	$SQL->Select($Req);
	return $SQL->FetchArray();
}



?>
