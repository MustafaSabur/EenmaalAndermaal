<div class="container-fluid">
	<div class="row row-nomargin zoekbalk">    
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
		    <div class="input-group">
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control" name="x" placeholder="Zoek voorwerp..." id="zoeken" onkeyup="autocomplet()">
                <ul id="zoeklijst"></ul>
                <div class="input-group-addon">
                    <!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">Rubriek</span> <span class="caret"></span>
                    </button> -->
                    
                    <select name="Rubriek" class="btn rub-select">
                        <option>Alles</option>
                        <option>Computerssddsfs</option>
                    </select>
                </div>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>

            </div>
        </div>
	</div>
</div>