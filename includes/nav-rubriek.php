<nav id="nav">
	<ul class="nav nav-pills nav-stacked main-menu">
		<h3>Rubrieken</h3>
        
        <?php 

        if (isset($_GET['rub_nr'])) {
        	printRubrieken($_GET['rub_nr'], 'li');
        }
        else {
        	printRubrieken();
        }
        ?>
        
    </ul>
    <!-- <ul class="nav nav-tabs nav-stacked dropdown-menu main-menu">
        
        
    </ul> -->
</nav>
