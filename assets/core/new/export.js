

String.prototype.capitalize = function () {
    return this.charAt(0).toUpperCase() + this.substring(1).toLowerCase();
};
//ON Vehicle Click
$('#tablestockin').on('click', 'tr', function (e) {

    id = $('.id', this).val();
    $.ajax({
        url: baseurl + "index.php/Exports/get",
        type: "POST",
        data: { id: id },
        success: function success(data) {
            data = JSON.parse(data);
            if (data.status === 'success') {
                vehicle = data.vehicle;
                //$('#vehicleinfo #id').val(vehicle.id);
                $('#vehicleinfo #vehicletitle').text(vehicle.make.capitalize() + ' ' + vehicle.name.capitalize());
                $('#vehicleinfo #year').html(vehicle.year);
                $('#vehicleinfo #addedby').html(vehicle.user.capitalize());
                $('#vehicleinfo #destination').html(vehicle.destination.capitalize());
                $('#vehicleinfo #dayspassed').html(vehicle.dayspassed);
                $('#vehicleinfo #status').html(vehicle.status.capitalize());
                $('#vehicleinfo #deliverydate').html(vehicle.deliverydate);

                stars = '';
                for (i = parseInt(vehicle.stars); i > 0; i--) {
                    stars += '<label class="star star-' + i + '" for="star-' + i + '"></label>';
                }

                $('#vehicleinfo #stars').html(stars);
                images = '';
                active = '';
                //Images
                if (vehicle.images) {
                    for (i = 0; i < vehicle.images.length; i++) {
                        if (i === 0) active = 'active';else active = '';

                        images += '<div class="item ' + active + '">\n                                            <img src="' + baseurl + 'assets/uploads/' + vehicle.id + '/' + vehicle.images[i] + '" style="width:330px; height:300px;border: 2px solid grey;">\n                                    </div>';
                    }
                } else {
                    //Have To Change Image Later
                    images += '<div class="item active">\n                                    <img src="' + baseurl + 'assets/1.jpg" style="width:330px; height:300px;border: 2px solid grey;">\n                                </div>';
                }
                $('#vehicleinfo #images').html(images);

                //Received
                if (vehicle.status === 'received') {
                    $('#status').removeClass('alert-warning');
                    $('#status').addClass('alert-success');
                }
                $('#vehicleinfo').modal('show');
            } else if (data.status === 'error') {
                console.log(data.msg);
            }
        },
        error: function error(_error) {
            console.log(_error);
        }
    });
});

//Model Closing
$('#addVehicle').on('hidden.bs.modal', function () {
    // do something…
    $('#vInfo', this).show();
    $('#vImages', this).hide();
});

//Model Closing
$('#vehicleinfo').on('hidden.bs.modal', function () {
    // do something…
    $('#status', this).addClass('alert-warning');
    $('#status', this).removeClass('alert-success');
    $('#exportData', this).hide();
    $('#sellData', this).hide();
});

$('#editVehicle').on('click', function (e) {
    $('#vehicleinfo').modal('hide');
    $('#addVehicle').modal('show');
});