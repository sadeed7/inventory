//Defining Filters (Name, Year)

//filter();
//console.log(filterData);
var error = `<div class="alert alert-danger alert-dismissible" role="alert">Error! No Result Found
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`;
//Search Result
$('#search').on('input', function(e){
	//console.log(this.value);
	key = this.value;
	if(key === ''){
		$('#filter').html('');
		$.each(nameFilterData, function(id,value){
			$('#filter').append(value);
		});
		if($('#filter').html() == ''){
			$('#filter').html(error);
		}
	}else if(isNaN(key)){
		$('#filter').html('');
		$.each(nameFilterData, function(id,value){
			
			id = id.toLowerCase();
			if(id.indexOf(key) !== -1){
				$('#filter').append(value);
			}
		});
		if($('#filter').html() == ''){
			$('#filter').html(error);
		}
	}else{
		$('#filter').html('');
		$.each(yearFilterData, function(id,value){
			
			id = id.toLowerCase();
			if(id.indexOf(key) !== -1){
				$('#filter').append(value);
			}
		});

		$.each(gradingFilterData, function(id,value){
			
			id = id.toLowerCase();
			if(id.indexOf(key) !== -1){
				$('#filter').append(value);
			}
		});
		if($('#filter').html() == ''){
			$('#filter').html(error);
		}
	}
});