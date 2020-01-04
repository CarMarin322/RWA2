<html>
<style>
#menu {

	background-color: lightgray;
	padding: 10px;		
}
#kategorije{
	float: left;  
	width: 20%;
	line-height: 1.9;
	background-color: #f1f1f1;

}
#naslovna{
	float: left;  
	width: 60%;
}

#trazilica{
	float: right; 
    width: 20%; 

}

.alignleft {
	float: left;
}

.alignright {
	float: right;
}

</style>






<div id=menu>

<?php include 'menu.php';?>

</div>
<body>
	<div id="kategorije" >		
			<ul style="list-style-type: none;">
            	<li style="background-color:darkgray">KATEGORIJE</li>
				<li>Prijenosna računala</li>
				<li>Računala</li>
				<li>Komponente</li>
				<li>Monitori</li>
				<li>Periferija</li>
				<li>Adapteri i kablovi</li>
			</ul>
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
    	<form action="/trazilica.php">
        <button type="submit">Pretraži</button>
      	<input type="text" name="trazilica">
		<a href="poruka.htm">
        	<img style="position:absolute; bottom:0px; " src="porukaimg.png" alt="Pošalji poruku" height="60" width="60">
        </a>


    </form>
    </div>
	
</body>






</html>