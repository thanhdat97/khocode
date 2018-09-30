<?php function day(){

for ($i = 1; $i<=31;$i++)
{
	echo '<option value="'.$i.'">'.$i,'</option>';
}
}
?>

<?php function thang(){

for ($i = 1; $i<=12;$i++)
{
	echo '<option value="'.$i.'">'.$i,'</option>';
}
}
?>

<?php function nam() {
	$namhientaij=getdate();
	for ($i = 1990; $i<=$namhientaij['year'];$i++)
{
	echo '<option value="'.$i.'">'.$i,'</option>';
}
}
?>