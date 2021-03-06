<?PHP
##########################################
#       CETTE CLASSE HTML � �T�          #
# PROGRAMM�E PAR L'UNIQUE ET FANTASTIQUE #
#             MASTAJEET                  #
#  UTILISATION PERMISE POUR QN		 #
##########################################


class HTML
{
	var $output;
	var $formname;
	
	function addoutput($string,$nl2br=1,$strip=1){
		if($nl2br)
			$string = nl2br($string);
		if($strip)
			$string = stripslashes($string);
		$this->output .= $string." \n";
	}
	
	function br($nb=1)	{
		$i=1;
		for($i; $i<=$nb; $i++)
		{
			$this->addoutput("\n",1,0);
		}
	}
	
	
	function center($string)	{
	return $output = "<div align=center>".$string."</div>";
	}
	
	function addtexte($string,$class="texte")	{

		$this->addoutput("<span class=$class>$string</span>");
	}
	
	
	function addlink($link,$texte="",$target="",$class="link")	{
		if($texte==""){
			$texte=$link;
		}
		$this->addoutput("<a href=\"".$link."\" target=\"".$target."\"><span class=$class>".$texte."</span></a>");
	}
	
	function addpic($pic,$Property="",$link="",$target="")	{
	$Txt = "<img src=\"".$pic."\" ".$Property.">";		
	if($link<>"")
		$this->addlink($link,$Txt,$taget);
	if($link=="")
		$this->addoutput($Txt);
	}
	

	function send($empty=0)	{
		if($empty){
		$Ret = $this->output;
		$this->emptyoutput();
		return $Ret;
		}
		return $this->output;
		
	}
	
	function stream($file,$Class=NULL){
		
		foreach(file($file.".inc") as $line)	{
			if (!is_null($Class))
				$this->addoutput(ereg_replace('%VARIABLE%',$Class,$line),0,0);
			else
				$this->addoutput($line,0,0);
		}
	}

        function streamLine($file,$NBLine){
		$Line = 1;
		foreach(file($file.".inc") as $line)	{
                    if($Line<=$NBLine) {
                                $this->addoutput($line,0,0);
                         $Line++;
                    }
                }
	}
	
	
	function emptyoutput()	{
		$this->output="";
	}
	
	function reqinfo($Action, $Table)	{
		$this->inputhidden_env('Action', $Action);
		$this->inputhidden_env('Table', $Table);
	}
	
	function opentable($width="100%", $cellspacing=2, $cellpadding=2, $border=0, $align=""){
		$this->addoutput("<table width=\"".$width."\" cellspacing=".$cellspacing." cellpadding=".$cellpadding." border=".$border." align=\"".$align."\">");
	}
	
	function closetable()	{
	$this->addoutput("</table>");
	}
	
	function openrow($height='',$class='')	{
		$this->addoutput("<tr height=\"".$height."\" class=\"".$class."\">");
	}
	
	function closerow()	{
		$this->addoutput("</tr>");
	}
	
	function opencol($width="", $colspan="1", $valign="top",$class="",$other="")	{
		$this->addoutput("<td width=\"".$width."\" colspan=".$colspan." valign=".$valign." class=\"".$class."\">");
	}
	
	function closecol()	{
		$this->addoutput("</td>");
	}
	
	function opendiv($width)	{
	$this->opentable($width,0,0,0);
	$this->openrow();
	$this->opencol();
	}
	
	function closediv()	{
	$this->closecol();
	$this->closerow();
	$this->closetable();
	}
	
	function addphone($number,$IND=FALSE,$class='texte'){
		if(strlen($number>=7)){
			if($IND){
				$this->AddTexte("(".substr($number,0,3).") ".substr($number,3,3)."-".substr($number,6,4),$class);
					if(strlen(substr($number,10,4))>1)
						$this->AddTexte(" #".substr($number,10,4));
				}else{
				$this->AddTexte(substr($number,3,3)."-".substr($number,6,4),$class);
					if(strlen(substr($number,10,4))>1)
						$this->AddTexte(" #".substr($number,10,4));	
			}
		}
	}
	
	function addform($titre=NULL, $action ="index.php", $method="POST", $name="FORM", $Jammed=FALSE)	{
		$this->formname = $name;
		if($Jammed)
			$this->opentable("60%",2,0);
		else
			$this->opentable("90%");		
		$this->addoutput("<form name=\"".$name."\"  action=\"".$action."\" method=\"".$method."\">");
		$this->inputhidden_env("postname", $this->formname);
		if($titre<>NULL)
		{
		$this->openrow();
		$this->opencol('',2);
		$this->addtexte($this->center($titre), "Titre");
		$this->closecol();
		$this->closerow();
		}
		$this->openrow();
		$this->opencol('20%');
		$this->closecol();
		$this->opencol('80%');
		$this->closecol();
		$this->closerow();
		
	}

	function postback($add){
			$this->inputhidden_env("PostBack", $_SERVER['HTTP_REFERER'].$add);
	}
	
	function inputfile($name, $description=NULL){
	if($description==NULL)
		{
		$description=$name;
		}
		$this->openrow();
		$this->opencol();
		$this->addtexte(ucfirst($description),"titre");
		$this->closecol();
		$this->opencol();
		$this->addoutput("<input type=file name=\"".$this->formname.$name."\" class=inputtext>");
		$this->closecol();
		$this->closerow();
	}

	function inputtext($name, $description=NULL, $size=28, $value=""){
		if($description==NULL)
		{
		$description=$name;
		}
		$this->openrow();
		$this->opencol();
		$this->addtexte(ucfirst($description),"titre");
		$this->closecol();
		$this->opencol();
		$this->addoutput("<input type=text name=\"".$this->formname.$name."\" size=".$size." value=\"".$value."\" class=inputtext>");
		$this->closecol();
		$this->closerow();
	}

	function inputphone($name, $description=NULL, $value="",$EXT=FALSE){
		if($description==NULL)
		{
		$description=$name;
		}
		$this->openrow();
		$this->opencol();
		$this->addtexte(ucfirst($description),"titre");
		$this->closecol();
		$this->opencol();
		$this->addtexte("(");
		$this->addoutput("<input type=text name=\"".$this->formname.$name."1\" size=3 value=\"".substr($value,0,3)."\" class=inputtext>");
		$this->addtexte(")&nbsp;");
		$this->addoutput("<input type=text name=\"".$this->formname.$name."2\" size=3 value=\"".substr($value,3,3)."\" class=inputtext>");
		$this->addtexte("-");
		$this->addoutput("<input type=text name=\"".$this->formname.$name."3\" size=4 value=\"".substr($value,6,4)."\" class=inputtext>");
		if($EXT){
			$this->addtexte(" #");
			$this->addoutput("<input type=text name=\"".$this->formname.$name."4\" size=4 value=\"".substr($value,10,5)."\" class=inputtext>");
		}

		$this->closecol();
		$this->closerow();
	}
	
	function inputtime($name, $description=NULL, $value=0,$val=array('Date'=>False,'Time'=>True)){
		
		if($value==0){
			$Heure = "0";
			$Min = "0";
			$Jour = "";
			$Mois = "";
			$Year = Date("Y",time());
		}else{
			if($value>86400){
				$Hour = bcmod($value,86400);
				$Jour = date('d',$value);
				$Mois = date('m',$value);
				$Year = date('Y',$value);
				$value = $Hour;
			}
			$Min = bcmod($value,3600)/60;
			$Heure = ($value-$Min*60)/3600;
		}
		if($description==NULL){
			$description=$name;
		}
		$this->openrow();
		$this->opencol();
		$this->addtexte(ucfirst($description),"titre");
		$this->closecol();
		$this->opencol();

		if($val['Date']){
			$this->addoutput("<input type=text name=\"".$this->formname.$name."5\" size=2 maxlength=2 value=\"".$Jour."\" class=inputtext>");
			$this->addtexte("&nbsp;");
			$this->addoutput("<select name=\"".$this->formname.$name."4\" class=inputselect>");
			$this->addoutput("<option value=' '> </option>");
			$month = get_month_list();
			foreach($month as $v => $o){
				$text = "";
				if($v==$Mois){
					$text = "SELECTED ";
				}
				$this->addoutput("<option value='".$v."' ".$text.">".$o."</option>");
			}
			$this->addoutput("</select>");
			$this->addtexte("&nbsp;");
			$this->addoutput("<input type=text name=\"".$this->formname.$name."3\" maxlength=4 size=4 value=\"".$Year."\" class=inputtext>");
			$this->addtexte("&nbsp;");
		}
		if($val['Time']){
		$this->addoutput("<input type=text name=\"".$this->formname.$name."2\" size=1 maxlength=2 value=\"".$Heure."\" class=inputtext>");
		$this->addtexte(":");
		$this->addoutput("<input type=text name=\"".$this->formname.$name."1\" size=1  maxlength=2 value=\"".$Min."\" class=inputtext>");
}

		$this->closecol();
		$this->closerow();
	}
	
	function inputpassword($name, $description=NULL, $size=28, $value=""){
		if($description==NULL)
		{
		$description=$name;
		}
		$this->openrow();
		$this->opencol();
		$this->addtexte(ucfirst($description),"titre");
		$this->closecol();
		$this->opencol();
		$this->addoutput("<input type=password name=\"".$this->formname.$name."\" size=".$size." value=\"".$value."\" class=inputtext>");
		$this->closecol();
		$this->closerow();
	}
	
	function inputhidden($name,$value){
		$this->addoutput("<input type=hidden name=\"".$this->formname.$name."\" value=\"".$value."\">");
	}
	
	function inputradio($name,$value,$selected=NULL,$description=NULL,$align='HOR'){
	if($description==NULL)
		{
			$description=$name;
		}
	$this->openrow();
		$this->opencol();
		$this->addtexte(ucfirst($description),"titre");
		$this->closecol();
		$this->opencol();
			$this->opentable();
			
			if($align=='HOR'){
						$this->openrow();
					foreach($value as $desc => $val){
						$text="";
						if($val==$selected)
							$text = "CHECKED";
						$this->opencol();
							$this->addoutput("<span class=texte>".$desc ."</span><input type=radio name=\"".$this->formname.$name."\" value=\"".$val."\" ".$text." class=inputradio class=inputradio>");
						$this->closecol();
					}
				}else{
				foreach($value as $val => $desc){
					$text="";
					if($val==$selected)
						$text = "CHECKED";
					$this->openrow();
					$this->opencol();
						$this->addoutput("<input type=radio name=\"".$this->formname.$name."\" value=\"".$val."\" ".$text." class=inputradio class=inputradio><span class=texte> ".$desc ."</span>");
					$this->closecol();
					$this->closerow();
				}
				}
			$this->closetable();
		$this->closecol();
		$this->closerow();
	}
	
	function inputselect($name, $option, $selected=NULL, $description=NULL, $NBMax=NULL)	{
		if($description==NULL)
		{
		$description=$name;
		}
		$this->openrow();
		$this->opencol();
		$this->addtexte(ucfirst($description),"titre");
		$this->closecol();
		$this->opencol();
		$this->addoutput("<select name=\"".$this->formname.$name."\" class=inputselect class=inputselect>");
		$this->addoutput("<option value=' '> </option>");
		
		if(is_array($option))
		{
			foreach($option as $value => $option)
			{
				$text = "";
				if($value==$selected)
				{
				$text = "SELECTED ";
				}
				$this->addoutput("<option value='".$value."' ".$text.">".$option."</option>");
			}
		}else{	
			$SQL = new SqlClass();
			$SQL->Select($option);
			while($rep = $SQL->fetcharray())
			{
				$text = "";
				if($rep[0]==$selected){
				$text = "SELECTED ";
				}
				$this->addoutput("<option value='".$rep[0]."' ".$text.">".$rep[1]);
				if(isset($rep[2]) AND ($NBMax>=2 OR is_null($NBMax)) )
					$this->addoutput(" ".$rep[2]);
				$this->addoutput("</option>");
			}

		}
		$this->addoutput("</select>");
		$this->closecol();
		$this->closerow();
	}
	
	function textarea($name, $description=NULL, $width=25, $height=5, $value=""){
	if($description==NULL)	{
			$description=$name;
		}
		$this->openrow();
		$this->opencol();
		$this->addtexte(ucfirst($description),"titre");
		$this->closecol();
		$this->opencol();
		$this->addoutput("<textarea name=\"".$this->formname.$name."\" cols=\"".$width."\" rows=\"".$height."\" class=textarea>".$value."</textarea>",0);
		$this->closecol();
		$this->closerow();
	}
	
	function flag($name, $chk=0, $description=NULL)
	{
	$checked ="";
	if($chk==1)
		{
		$checked = "checked";
		}
	if($description==NULL)
		{
		$description=$name;
		}
		$this->openrow();
		$this->opencol();
		$this->addtexte(ucfirst($description),"titre");
		$this->closecol();
		$this->opencol();
		$this->addoutput("<input name=\"".$this->formname.$name."\" type=checkbox value=1 $checked>");
		$this->closecol();
		$this->closerow();
	}
	
	function flaglist($name, $option, $selected=array(), $description=NULL)
	{
	// FAIRE LES MODIFICATION CAR MONT� EN BROCHE A FOIN
	if($description==NULL){
			$description=$name;
		}
		$this->openrow();
		$this->opencol();
		$this->addtexte(ucfirst($description),"titre");
		$this->closecol();
		$this->opencol();
				
		if(is_array($option)){
				$this->opentable();
				$this->openrow();
				foreach($option as $desc => $val){
					$this->opencol();
						$this->addoutput("<span class=texte>".$val."</span><input type=checkbox name=\"".$this->formname.$name."[".$desc."]\" value=1 class=inputradio>");
					$this->closecol();
				}
				$this->closerow();
				$this->closetable();
		}else{
		
			$SQL = new SqlClass();
			$SQL->Select($option);
			$this->opentable();
			while($rep = $SQL->fetcharray()){
					$this->openrow();
					$this->opencol();
					$this->addoutput("<span class=texte>".$rep[1]." </span><input type=checkbox name=\"".$this->formname.$name."[".$rep[0]."]\" value=1 class=inputradio>");
					$this->closecol();
					$this->closerow();
			}
			$this->closetable();		
		}
		$this->closecol();
		$this->closerow();
	}
	
	function formsubmit($string='Ex�cuter'){
		$this->openrow();
		$this->opencol("",2);
		$this->addoutput($this->center("<input type=submit value=\"".$string."\"></form>"));
		$this->closecol();
		$this->closetable();
	}
	
	function inputhidden_env($name, $value)	{
		$this->addoutput("<input type=hidden name=\"".$name."\" value=\"".$value."\">");
	}
	
	
}
