<link rel="stylesheet" type="text/css" href="../vendor/font-awesome/css/font-awesome.min.css">
<style type="text/css">*{font-size: 20px;}</style>
<pre>
<?php
	$iconPerLine = 15;
	$listIcon = file_get_contents('list-icon.txt');
	$listIcon = explode("\n", $listIcon);
	foreach ($listIcon as $index => $icon) {
		echo("<i class=\"{$icon}\" title=\"{$icon}\"></i>\t");
		echo($icon);
		if($icon == '' || $index % $iconPerLine ==0){
			echo('<br>');
		}
	}
?>