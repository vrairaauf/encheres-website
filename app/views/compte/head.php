<?php
echo '<div>';
if(isset($_POST['affichemenue'])){
	
	if($_POST['affichemenue']==='hiddenmenu'){
		$versetat='showmenu';
	}else{
		$versetat='hiddenmenu';
	}
}else{
	$versetat='showmenu';
}
echo '<table class="tetesite">';
echo '<tr>';
echo '<td>';
echo '<form method="post">';

echo '<input type="hidden"  name="affichemenue" value="'.$versetat.'">';

echo '<button type="submit"><i class="fas fa-search"></i></button>';
echo '</form>';
echo '</td>';
echo '<td>';

echo '</td>';
echo '</tr>';
echo '</table>';

echo '</div>';	
?>