multipleArray = [];
$('#vehicles option').on('click', function(e){
	e.preventDefault();
	if (typeof $(this).attr('disabled') === 'undefined'){
		
		multipleArray.push({
			'option_id': $(this).attr('id'),
			'vehicle_id': $(this).val()
		});
		$(this).attr('disabled','disabled');
		console.log(multipleArray);
		html = `<li><a href="${$(this).attr('id')}" style="float:right;font-size:24px;" class="cancelvehicle">&times;</a>${$(this).text()}</li>`;
		$('#selectedvehicles').append(html);

	}
		//$(this).removeAttr('disabled');
	
});

$('#selectedvehicles').on('click', '.cancelvehicle', function(e){
	e.preventDefault();
	;
	$('#vehicles #'+$(this).attr('href')).removeAttr('disabled');

	$(this).parent()[0].remove();
	//Removing From Array
})