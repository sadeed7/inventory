//Station Changed
$('#station').on('change', function(e){
	action = $(this).val();

	if(action === 'all'){
		$.ajax({
			url: baseurl+'index.php/Zakat/overall',
			type: 'POST',
			success: function(data){
				data = JSON.parse(data);
				if(data.status === 'success'){
					data = data.zakat;
					$('#cash').html(data.cash);
					$('#stock').html(data.stock);
					$('#total').html(data.total);
					$('#zakat').html(data.zakat);

				}else if(data.status === 'error'){
					console.log(data.msg);
				}
			},
			error: function(error){
				
			}
		})
	}else if(action !== ''){
		$.ajax({
			url: baseurl+'index.php/Zakat/stationzakat',
			type: 'POST',
			data: {id: action},
			success: function(data){
				data = JSON.parse(data);
				if(data.status === 'success'){
					data = data.zakat;
					$('#cash').html(data.cash);
					$('#stock').html(data.stock);
					$('#total').html(data.total);
					$('#zakat').html(data.zakat);
				}else if(data.status === 'error'){
					console.log(data.msg);
				}
			},
			error: function(error){
				console.log(error);
			}
		})
	}
})