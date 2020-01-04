<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stil.css">
	
		<style>

			#naslovna{
				float: left;  
				width: 60%;
			}

			.alignleft {
				float: left;
			}

		</style>

	</head>

	<body>
		<div id=menu>
			<?php include 'templates/menu.php';?>
		</div>
		
		<div id="kategorije" >		
			<?php include 'templates/kategorije.php'?>
		</div>

		<div id="naslovna">
			<div> <!--Prazan div 1 -->
			</div>
				
			<div> <!--Prazan div 2 -->
			</div>
		
			<div> <!--Prazan div 3 -->
			</div>
	
			<div> <!--Prazan div 4 -->
			</div>
		</div>

		<div id="trazilica">
			<?php include 'templates/trazilicaIPoruka.php'?>
		</div>
		
	</body>
</html>