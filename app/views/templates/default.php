<!DOCTYPE html>
<html>
<head>
	<title>default</title>
	<meta charset="utf-8">
	<meta name="viewpot" content="width=device-width initiale-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../public/css/principal.css">
	<link rel="stylesheet" type="text/css" href="../public/css/font/fontawesome-free-5.15.3-web/css/all.css">
</head>
<body>
<div class="templatemain">
	<table>
		<tr>
			<td id="fenetre"></td>
			<td id="contenu">

				<?php
				echo '<div class="menudenavigation">';
				require '../app/views/compte/head.php';
				echo '</div>';
				?>
				<div style="text-align: center;"> <h2 style="text-align: center;"><strong>batta.tn</strong></h2></div>
			</td>
			<td id="pub"></td>
		</tr>
		<tr>
			<td id="fenetredef">
			<?php
				require '../app/views/compte/menudenavigation.php';
			?>	

			</td>
			<td id="centerdef">
				<?php require '../app/views/compte/menu.php'; ?>
				<?php echo $content; ?>
				<div class="publicitecenter">
			<p>
				<a href=""><img src="../app/views/publicite/image/th (3).jpg"></a>
			</p>
</div>
			</td>
			<td id="pub">
				<?php
				require '../app/views/publicite/publicite.php';
			?>
			</td>
		</tr>
		<tr>
			<td colspan="3"><?php require '../app/views/compte/footer.php' ?></td>
		</tr>
	</table>
</div>
</body>
</html>