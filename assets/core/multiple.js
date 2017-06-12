String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.substring(1).toLowerCase();
}

var divid;

var multipleArray = [];
//Adding Vehicle To List And Array
$('#vehicles option').on('click', function(e){
	e.preventDefault();
	if (typeof $(this).attr('disabled') === 'undefined'){
		
		multipleArray.push({
			'option_id': $(this).attr('id'),
			'vehicle_id': $(this).val()
		});
		$(this).attr('disabled','disabled');
		
		var html = `<div class="col-md-12"><a href="${$(this).attr('id')}" style="float:right;font-size:24px;" class="cancelvehicle">&times;</a><span style="float:left;">${$(this).text()}</span></div>`;
		$('#selectedvehicles').append(html);

	}
		//$(this).removeAttr('disabled');
	
});

//Deleting From List And Array
$('#selectedvehicles').on('click', '.cancelvehicle', function(e){
	e.preventDefault();
	var id = $(this).attr('href');
	$('#vehicles #'+$(this).attr('href')).removeAttr('disabled');

	$(this).parent()[0].remove();

	//Removing From Array
	multipleArray = multipleArray.filter(function( obj ) {
  		return obj.option_id !== id;
	});
	
});

//Adding Container
$('#multiexport_form').on('submit', function(e){
	e.preventDefault();
	var vehicles = [];
	for (var i = 0; i < multipleArray.length; i++) {
		vehicles.push(multipleArray[i].vehicle_id);
	}
	
	if(vehicles.length < 1){
		$('#containerVerificationError').css('color', 'red');
		$('#containerVerificationError').html('Vehicles Required');
		return false;
	}

	var formData = $('#multiexport_form').serializeArray();

	formData.push({
		name:'vehicles[]',
		value:vehicles
	});
	$.ajax({
		url: baseurl + 'index.php/Containers/add',
		type: "POST",
		data: formData,
		success: function(data){
			data = JSON.parse(data);
			if (data.status === 'success') {
				$('#containerVerificationError').css('color', 'green');
				$('#containerVerificationError').html("Container Successfully Added");
				window.location = baseurl + 'index.php/Containers';
			}else if(data.status === 'error'){
				$('#containerVerificationError').css('color', 'red');
				$('#containerVerificationError').html(data.msg);
			}
		},
		error: function(error){
			$('#containerVerificationError').css('color', 'red');
			$('#containerVerificationError').html(error);
		}
	});

});

//Container Select
$('#tablecontainers').on('click','tr', function(e){
    id = $('.id',this).val();
    $.ajax({
    	url: baseurl+"index.php/Containers/get",
    	type: "POST",
    	data:{id:id},
    	success: function(data){
    		data = JSON.parse(data);
    		if(data.status === "success"){
    			container = data.container;
    			
    			$('#containerinfo #received #id').val(container.id);
    			$('#containerinfo #containertitle').text('Container Information');
    			$('#containerinfo #refrence').html(container.refrence);
    			$('#containerinfo #destination').html(container.location);
    			$('#containerinfo #expected').html(container.deliverydate);
    			$('#containerinfo #status').html(container.status.capitalize());
    			$('#containerinfo #cost').html(container.cost);
    			
    			
    			var vehicles = '<h4 style="font-weight:bold">Vehicles:</h4>';
    			if(container.vehicles.length > 0){
    				for (var i = 0; i < container.vehicles.length; i++) {
    					if(container.vehicles[i].status === 'received')
    						color = 'lightblue';
    					else
    						color = 'yellow';
    					x = i+1;
    					vehicles += '<div class="col-md-12"  id="v'+container.vehicles[i].id+'" style="margin-top:2px; font-weight:bold;background-color:'+color+'"><span>'+x+'.&nbsp;&nbsp;</span><a href="'+container.vehicles[i].id+'" class="vinfo">'+container.vehicles[i].chassis+' ('+container.vehicles[i].name+' '+container.vehicles[i].year+')</a></div>'; 
    				}
    			}
    			
    			$('#containerinfo #vehicles').html(vehicles);
    			
    			//Received
                if(container.status === 'received'){
                	
                	$('#containerinfo #status').removeClass('alert-warning');
					$('#containerinfo #status').addClass('alert-success');
                }


    			$('#containerinfo').modal('show');

    		}else if(data.status === "error"){
    			console.log(data.msg);
    		}
    	},
    	error: function(error){
    		console.log(error);
    	}
    });


    
});


//Selecting Vehicle
$('#containerinfo #vehicles').on('click', '.vinfo', function(e){
	e.preventDefault();
	
	id = $(this).attr('href');
	divid = id;

	$.ajax({
        url: baseurl+"index.php/Imports/get",
        type: "POST",
        data: {id:id},
        success: function(data){
            data = JSON.parse(data);
            if(data.status === 'success'){
                vehicle = data.vehicle;
                $('#vehicleinfo #id').val(vehicle.id);
                $('#vehicleinfo #vehicletitle').text(vehicle.make.capitalize()+' '+vehicle.name.capitalize());
                $('#vehicleinfo #year').html(vehicle.year);
                $('#vehicleinfo #addedby').html(vehicle.user.capitalize());
                $('#vehicleinfo #destination').html(vehicle.destination.capitalize());
                $('#vehicleinfo #dayspassed').html(vehicle.dayspassed);
                $('#vehicleinfo #status').html(vehicle.status.capitalize());
                $('#vehicleinfo #deliverydate').html(vehicle.deliverydate);

                stars = '';
                for(i = parseInt(vehicle.stars) ; i > 0; i--){
                    stars += `<label class="star star-${i}" for="star-${i}"></label>`                   
                }

                $('#vehicleinfo #stars').html(stars);
                images = ``;
                active = '';
                //Images
                if(vehicle.images){
                    for(i = 0; i < vehicle.images.length; i++){
                        if(i === 0)
                            active = 'active';
                        else
                            active = '';

                        images += `<div class="item ${active}">
                                            <img src="${baseurl}assets/uploads/${vehicle.id}/${vehicle.images[i]}" style="width:330px; height:300px;border: 2px solid grey;">
                                    </div>`;
                    }
                }else{
                    //Have To Change Image Later
                    images += `<div class="item active">
                                    <img src="${baseurl}assets/1.jpg" style="width:330px; height:300px;border: 2px solid grey;">
                                </div>`;
                }
                $('#vehicleinfo #images').html(images);

                //Received
                if(vehicle.status === 'received' && role === 'seller'){
                	$('#rec').hide();
                	$('#vehicleinfo #status').removeClass('alert-warning');
					$('#vehicleinfo #status').addClass('alert-success');
                }

                $('#vehicleinfo').modal('show');

            }else if(data.status === 'error'){
                console.log(data.msg);
            }
        },
        error: function(error){
            console.log(error);
        }
    });
	
});

//Container Received
$('#receivedform').on('submit', function(e){
	e.preventDefault();
	formData = $("#receivedform").serialize();
	$.ajax({
		url: baseurl+'index.php/Imports/received',
		type: 'POST',
		data: formData,
		success: function(data){
			data = JSON.parse(data);
			if(data.status === 'success'){
				$('#vehicleinfo #status').html('Received');
				$('#vehicleinfo #status').removeClass('alert-warning');
				$('#vehicleinfo #status').addClass('alert-success');
				$('#vehicleinfo #rec').hide();
				$('#vehicleinfo #received').hide();

				$('#containerinfo #v'+divid).css('background-color', 'lightblue');                


                $('#vehicleinfo').modal('hide');


                $('#alert').html(`<div class="alert alert-success alert-dismissible" role="alert">Vehicle Status Successfully Updates.. 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`);


			}else if(data.status ==='error'){
                $('#vehicleinfo').modal('hide');
				$('#alert').html(`<div class="alert alert-danger alert-dismissible" role="alert">${data.msg}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`);
			}
		},
		error: function(error){
			console.log(error);
		}
	})

});
	
//Container Model Closing
$('#multipleexport').on('hidden.bs.modal', function () {
 	// do something…
        
	$('#containerVerificationError').html('');
	$('#multiexport_form').trigger("reset");
	$('#selectedvehicles').html('');
	multipleArray = [];
    

});

//Vehicle Model Closing
$('#vehicleinfo').on('hidden.bs.modal', function () {
    // do something…
    $('#receivedform').trigger("reset");    
    
    $('#exportData',this).hide();
    $('#sellData',this).hide();
    
    $('#rec', this).show();

    $('#status',this).html('En route');
    $('#status',this).addClass('alert-warning');
    $('#status',this).removeClass('alert-success');
    $('#received').hide();


});