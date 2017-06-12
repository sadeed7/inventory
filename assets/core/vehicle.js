String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.substring(1).toLowerCase();
}

function refreshTable () {
	$('.datatable').each(function() {
    	dt = $(this).dataTable();
    	dt.fnDraw();
	})
}

//Vehicle Select
$('.tablestockin').on('click','tr', function(e){
    id = $('.id',this).val();
    $.ajax({
    	url: baseurl+"index.php/Inventory/get",
    	type: "POST",
    	data:{id:id},
    	success: function(data){
    		data = JSON.parse(data);
    		if(data.status === "success"){
    			vehicle = data.vehicle;
    			
    			$('#vehicleinfo #id').val(vehicle.id);
    			$('#vehicleinfo #vehicletitle').text(vehicle.make.capitalize()+' '+vehicle.name.capitalize());
    			$('#vehicleinfo #year').html(vehicle.year);
    			$('#vehicleinfo #addedby').html(vehicle.addedby.capitalize());
    			$('#vehicleinfo #location').html(vehicle.location.capitalize());
    			$('#vehicleinfo #price').html(vehicle.price);
    			$('#vehicleinfo #cost').html(vehicle.cost);
    			$('#vehicleinfo #status').html(vehicle.status);
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
    			
    			//IF Vehicle Already Exported
    			if(!vehicle.exported){
    				$('#exportbtn').show();
    			}else{
    				$('#exportbtn').hide();
    			}
    			
    			if(vehicle.status === 'Sold'){
    				$('#sellbtn').hide();
    				$('#editVehicle').hide();
                    $('#vehicleinfo #time').html('');
    			}else{
    				$('#sellbtn').show();
    				$('#editVehicle').show();
                    


    			}

                //Date

                var date = new Date(vehicle.date);
                var dd = date.getDate();
                var mm = date.getMonth()+1; //January is 0!
                var yyyy = date.getFullYear();

                if(dd<10) {
                    dd='0'+dd
                } 
 
                var months = [ "January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December" ];
                mm = months[mm]            
                date = dd+' '+mm+', '+yyyy;
                
                $('#vehicleinfo #time').html(`<label>Purchase Date: <span id="date">${date}</span></label><br>`);

                //Date


    			$('#vehicleinfo').modal('show');

    		}else if(data.status === "error"){
    			console.log(data.msg);
    		}
    	},
    	error: function(error){
    		console.log(error);
    	}
    });


    
});


//Vehicle Edit Button Click
$('#editVehicle').on('click',function(e){
        $('#vehicleinfo').modal('hide');
        id = $('#vehicleinfo #id').val();
        //Getting Data
        $.ajax({
        	url:baseurl+'index.php/Inventory/get',
        	type:'POST',
        	data:{id:id},
        	success: function(data){
        		data = JSON.parse(data);
        		if(data.status === 'success'){
        			vehicle = data.vehicle;

        			$('#vehicle_form #id').val(vehicle.id);
        			$('#vehicle_form #name').val(vehicle.name);
        			$('#vehicle_form #chassis').val(vehicle.chassis);
        			$('#vehicle_form #make').val(vehicle.make);
        			$('#vehicle_form #model').val(vehicle.model);
        			$('#vehicle_form #year').val(vehicle.year);
        			$('#vehicle_form #stars').val(vehicle.stars);
        			$('#vehicle_form #price').val(vehicle.price);


        			services = vehicle.services;
        			serviceshtml = ``;
        			if(services){
        				service = 0;
        				for(i = 0; i < services.length; i++){
        					serviceshtml += `
        					<div class="form-group services" id="service${service}">                            
                    			<input type="hidden" name="serviceid[]" value="${services[i].id}" id="serviceid${service}">
                    			<div class="col-md-3">
                        			<input type="text" class="form-control c-square c-theme" name="servicename[]" id="servicename${service}" placeholder="Service Name" value="${services[i].service_name}" required>
                    			</div>                
                    			<div class="col-md-8">
                        			<input type="text" class="form-control c-square c-theme" name="serviceprice[]" id="serviceprice${service}" placeholder="Price" value="${services[i].service_price}" required>
                    			</div>
                    				<a href="javascript:;" class="col-md-1" onclick="removeService(${service})" ><i class="fa fa-times" title="Remove Service"></i></a>
                				</div>
                				<div class="clearfix" id="clearfix${service}"></div>
                				<br id="br${service}">
                			`;
                			service++;
        				}
        				$('#vehicle_form #service').html(serviceshtml);
        			}
        			images = vehicle.images;
        			imageshtml = ``;
        			if(images){
        				//x = 0;
        				for(i = 0; i < images.length; i++){
    						style="overflow-y:scroll;height:300px;"
    						$('#imagesedit').css('height','300px');
    						$('#imagesedit').css('overflow-y','scroll');
    						imageshtml += `<div class="col-md-6" id="editimage${i}">
                                    <a href="javascript:;" onclick="deleteimg('${vehicle.id}','${vehicle.images[i]}','${i}')" style="float:right;font-size:20px;font-weight:bold;">&times;</a>
                                    <img src="${baseurl}assets/uploads/${vehicle.id}/${vehicle.images[i]}" style="width:200px; height:200px;border: 2px solid grey;">
                                </div>
                                `;
                            /*x++;    
                            if(x%2 === 0 && x !== 1){    
                            	imageshtml +=`
                                	<div class="clearfix"></div>
                                	<br>`;
                            } */   
    					}
    				}else{
    					//Have To Change Image Later
    					$('#imagesedit').css('height','auto');
    					$('#imagesedit').css('overflow-y','auto');
    					imageshtml += ``;
    				}
        			

    				$('#imagesedit').html(imageshtml);

        			$('#addvehiclebtn').val('edit');
        			$('#addVehicle').modal('show');

        		}else{

        			console.log(data.msg);

        		}
        		
        	},
        	error: function(error){
        		console.log(error);
        	}

        })
        
        
});


//Add Vehicle Model Closing
$('#addVehicle').on('hidden.bs.modal', function () {
    // do something…
    service = 0;
    
    $('#imagesedit').css('height','auto');
    $('#imagesedit').css('overflow-y','auto');
    $('#imagesedit').html('');


    $('#vehicle_form').trigger("reset");
    $('#addvehiclebtn').val('save');

    $('#verificationError').hide();
    $('#vInfo',this).show();
    $('#vImages',this).hide();
    

});


//Submitting Add Vehicle Form
$('#vehicle_form').on('submit', function(e){
	e.preventDefault();
	action = $('#addvehiclebtn').val();
	formData = $("#vehicle_form").serialize();
	
	//Saving Action
	if(action === 'save'){
		//Save Vehicle Information
		$.ajax({
		url : baseurl+'index.php/Inventory/add',
		type: "POST",
		data: formData,
		success: function(data){
			data = JSON.parse(data);
			
			if(data.status === 'success'){
				$('#verificationError').hide();
				vehicle = data.vehicle;
				//Changing Parameter of Uploader
				manualUploader._paramsStore.set({id:vehicle.id});
				rowCount = $('#tablestockin tr').length+1;
				row = `<tr  class="odd gradeX" id="vehicle${vehicle.id}">

                  <td class="hidden-480"><span class="sr">${rowCount}<span><input type="hidden" class="id" value= "${vehicle.id}"></td>
                  <td class="hidden-480 token">${vehicle.name}</td>
                  <td class="hidden-480">${vehicle.chassis}</td>
                  <td class="hidden-480 location">${vehicle.location}</td>
                  <td class="hidden-480 st">${vehicle.status}</td> 
                  <td class="hidden-480 date">0 days</td> 
                  </tr> `;

				$('#tablestockin').append(row);
				


				$('#vImages').show();
				$('#vInfo').hide();
			}else if(data.status === 'error'){
				$('#verificationError').html(data.msg);
				$('#verificationError').show();
			}

			
		},
		error: function(error){
			console.log(error);
		}
	});
	
	}else if(action === 'edit'){
		//Edit Vehicle Information
		$.ajax({
		url : baseurl+'index.php/Inventory/edit',
		type: "POST",
		data: formData,
		success: function(data){
			data = JSON.parse(data);
			
			if(data.status === 'success'){
				$('#verificationError').hide();
				vehicle = data.vehicle;
				//Changing Parameter of Uploader
				manualUploader._paramsStore.set({id:vehicle.id});

				loc = $(`#tablestockin #vehicle${vehicle.id} .location`).html();
				dat =$(`#tablestockin #vehicle${vehicle.id} .date`).html();
				sr =$(`#tablestockin #vehicle${vehicle.id} .sr`).html();
				stat = $(`#tablestockin #vehicle${vehicle.id} .st`).html();

                $(`#tablestockin #vehicle${vehicle.id}`).remove(); 

				
				row = `<tr  class="odd gradeX" id="vehicle${vehicle.id}">

                  <td class="hidden-480 sr"><span class="sr">${sr}</span><input type="hidden" class="id" value= "${vehicle.id}"></td>
                  <td class="hidden-480 token">${vehicle.name}</td>
                  <td class="hidden-480">${vehicle.chassis}</td>
                  <td class="hidden-480 location">${loc}</td>
                  <td class="hidden-480 st">${stat}</td>
                  <td class="hidden-480 date">${dat}</td> 
                  </tr> `;
				$('#tablestockin').append(row);
				

				$('#vImages').show();
				$('#vInfo').hide();
			}else if(data.status === 'error'){
				$('#verificationError').html(data.msg);
				$('#verificationError').show();
			}

			
		},
		error: function(error){
			console.log(error);
		}
	});
	}	

	
});


//Export Button
$('#exportbtn').on('click',function(){
	$('#exportData').show();
	$('#sellData').hide();
});


//Export Vehicle
$('#exportform').on('submit', function(e){
	e.preventDefault();
	id = $('#vehicleinfo #id').val();
	formData = $("#exportform").serializeArray();
	formData.push({name:'vehicle_id',value:id});

	//Export Request
	$.ajax({
		url: baseurl+'index.php/Inventory/export',
		type: 'POST',
		data: formData,
		success: function(data){
			data = JSON.parse(data);
			if(data.status === 'success'){
				
				//Success Alert
				$('#alert').html(`<div class="alert alert-success alert-dismissible" role="alert">Vehicle Exported Successfully Updates.. 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`);
				$('#vehicleinfo').modal('hide');

			}else if(data.status === 'error'){
				//Error Alert
				$('#alert').html(`<div class="alert alert-danger alert-dismissible" role="alert">${data.msg}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`);
				$('#vehicleinfo').modal('hide');
			}
		},
		error: function(error){
			console.log(error);
		}
	})

});


//Selling Vehicle	
$('#sellform').on('submit',function(e){
	e.preventDefault();
	id = $('#vehicleinfo #id').val();
	formData = $('#sellform').serializeArray();
	formData.push({name:'vehicle_id',value:id});

	//Selling Request
	$.ajax({
		url: baseurl+'index.php/Inventory/sell',
		type: 'POST',
		data: formData,
		success: function(data){
			data = JSON.parse(data);
			if(data.status === 'success'){
				$('#alert').html(`<div class="alert alert-success alert-dismissible" role="alert">Vehicle Sold Successfully.. 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`);
				$('#vehicleinfo').modal('hide');
			}else if(data.status === 'error'){
				$('#alert').html(`<div class="alert alert-danger alert-dismissible" role="alert">${data.msg}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`);
				$('#vehicleinfo').modal('hide');
			}
		},
		error: function(error){
			console.log(error);
		}
	});
});
