

String.prototype.capitalize = function () {
    return this.charAt(0).toUpperCase() + this.substring(1).toLowerCase();
};

$('#tablestockin tr').on('click', function (e) {
    id = $('.id', this).val();
    if (typeof id !== 'undefined') {
        $.ajax({
            url: baseurl + "index.php/Inventory/get",
            type: "POST",
            data: { id: id },
            success: function success(data) {
                data = JSON.parse(data);
                if (data.status === "success") {
                    vehicle = data.vehicle;

                    $('#vehicleinfo #id').val(vehicle.id);
                    $('#vehicleinfo #vehicletitle').text(vehicle.make.capitalize() + ' ' + vehicle.name.capitalize());
                    $('#vehicleinfo #year').html(vehicle.year);
                    $('#vehicleinfo #addedby').html(vehicle.addedby.capitalize());
                    $('#vehicleinfo #location').html(vehicle.location.capitalize());
                    $('#vehicleinfo #price').html(vehicle.price);
                    $('#vehicleinfo #cost').html(vehicle.cost);
                    $('#vehicleinfo #status').html(vehicle.status);
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

                    //IF Vehicle Already Exported

                    $('#exportbtn').hide();
                    $('#sellbtn').hide();
                    $('#editVehicle').hide();

                    //IF Vehicle Already Exported
                    if (!vehicle.exported) {
                        $('#exportbtn').show();
                    } else {
                        $('#exportbtn').hide();
                    }

                    if (vehicle.status === 'Sold') {

                        $('#vehicleinfo #time').html('');
                    } else {
                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth() + 1; //January is 0!
                        var yyyy = today.getFullYear();

                        if (dd < 10) {
                            dd = '0' + dd;
                        }

                        if (mm < 10) {
                            mm = '0' + mm;
                        }

                        today = mm + '/' + dd + '/' + yyyy;

                        var date2 = new Date(vehicle.date);
                        var date1 = new Date(today);

                        var diff = date1 - date2;
                        var days = diff / 1000 / 60 / 60 / 24;
                        console.log(days);

                        $('#vehicleinfo #time').html('<label>InStock Time: <span class="alert-warning" id="status">' + days + ' Days</span></label><br>');
                    }

                    //Date

                    var date = new Date(vehicle.date);
                    var dd = date.getDate();
                    var mm = date.getMonth() + 1; //January is 0!
                    var yyyy = date.getFullYear();

                    if (dd < 10) {
                        dd = '0' + dd;
                    }

                    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    mm = months[mm];
                    date = dd + ' ' + mm + ', ' + yyyy;

                    $('#vehicleinfo #time').html('<label>Purchase Date: <span id="date">' + date + '</span></label><br>');

                    //Date  

                    $('#vehicleinfo').modal('show');
                } else if (data.status === "error") {
                    console.log(data.msg);
                }
            },
            error: function error(_error) {
                console.log(_error);
            }
        });
    } else {
        console.log('Undefined');
    }
});