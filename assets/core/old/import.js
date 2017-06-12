String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.substring(1).toLowerCase();
}


//ON Vehicle Click
$('#tablestockin').on('click', 'tr', function(e){
    
    id = $('.id',this).val();
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
                if(vehicle.status === 'received'){
                	$('#rec').hide();
                	$('#status').removeClass('alert-warning');
					$('#status').addClass('alert-success');
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
				$('#status').html('Received');
				$('#status').removeClass('alert-warning');
				$('#status').addClass('alert-success');
				$('#rec').hide();
				$('#received').hide();
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



//Model Closing
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