<nav id="nav">
	<ul class="nav nav-pills nav-stacked main-menu">
		
        
        <?php 

        if (isset($_GET['rub_nr'])) {
        	printRubrieken($_GET['rub_nr'], 'li');
        }
        else {
        	printRubrieken();
        }
        ?>
        
    </ul>

</nav>
