<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Untitled Document</title>
</head>

<body bgcolor="#669933">
<?php
//$file = file_get_contents('C:\Documents and Settings\Ehsan\Desktop\yahoo message pages\1.htm');
/*$line = substr($file,'profiles.yahoo.com/');
echo $line;
$fromprofile = strstr($line, 'profiles.yahoo.com/');
$slash = strpos($fromprofile,'/');
$quote = strpos($fromprofile,'"');
$yahooid = substr($fromprofile,$slash+1,$quote-$slash-1);*/
//echo $yahooid;
/*<title>
lumsdotnet : Messages : 52-81 of 81 </title>
51?viscount=-30&l=1
1?l=1*/
set_time_limit(300);
$messages = 'http://groups.yahoo.com/group/punjabuniversitylahore/messages';
$nextpage = $messages;
$msgnum = 31;
while ($msgnum>30) 
{
	$lines = file($nextpage);//'C:\Documents and Settings\Ehsan\Desktop\yahoo message pages\31.htm');
	$nextpage = '';
	if($lines)
	{
		foreach ($lines as $line)
		{
			if(strlen($nextpage)==0)
			{
				$title = strstr($line,'Messages :');
				if($title)
				{
					$start = strpos($title,':') + 2;
					$len = strpos($title,'-') - $start;
					$msgnum = substr($title,$start,$len);
					$nextpage = $messages.'/'.($msgnum-1).'?viscount=-30&l=1';
					echo $nextpage;echo "<br />";
				}
			}
			else 
			{
				$fromprofile = strstr($line, 'profiles.yahoo.com/');
				if($fromprofile)
				{
					$start = strpos($fromprofile,'/') + 1;
					$len = strpos($fromprofile,'"') - $start;
					$yahooid = substr($fromprofile,$start,$len);
					$yahooid = str_ireplace('%2E','.',$yahooid);
					echo $yahooid;
					echo "<br />";
				}
			}
		}
	}
	else {echo 'page not found';}
}
?>
</body>
</html>
