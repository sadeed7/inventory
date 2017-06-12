

$('.fund').on('click', function (e) {
	e.preventDefault();

	if (confirm("Are You Sure That Funds Are Received?")) {

		fundid = $(this).val();
		notid = $('.id ', '#fund' + fundid).val();

		$.ajax({
			url: baseurl + 'index.php/Accounts/received',
			type: 'POST',
			data: {
				fund: fundid,
				notification: notid
			},
			success: function success(data) {
				data = JSON.parse(data);
				if (data.status === 'success') {
					//Funds Transfered Successfully
					console.log(data.msg);
					//Notification Count
					notcount = $('#notcount').html();
					notcount = parseInt(notcount) - 1;
					$('#notcount').html(notcount);

					//Removing Notification
					$('#fund' + fundid).remove();
				} else if (data.status === 'error') {
					console.log(data.msg);
				}
			},
			error: function error(_error) {
				console.log(_error);
			}
		});
	} else {
		//Do Nothing
	}
});

$('.other').on('click', function (e) {

	e.preventDefault();

	notid = $(this).attr('href');

	$.ajax({
		url: baseurl + 'index.php/Notification/seen',
		type: 'POST',
		data: {
			notification: notid
		},
		success: function success(data) {
			data = JSON.parse(data);
			if (data.status === 'success') {
				//Funds Transfered Successfully
				console.log(data.msg);
				//Notification Count
				notcount = $('#notcount').html();
				notcount = parseInt(notcount) - 1;
				$('#notcount').html(notcount);

				//Removing Notification
				$('#other' + notid).remove();
			} else if (data.status === 'error') {
				console.log(data.msg);
			}
		},
		error: function error(_error2) {
			console.log(_error2);
		}
	});
});