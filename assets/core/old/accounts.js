

//Funds Transfer
$('#transferform').on('submit', function(e){
	e.preventDefault();
	formData = $('#transferform').serialize();

	$.ajax({
		url: baseurl+'index.php/Accounts/transfer',
		type: 'POST',
		data: formData,
		success: function(data){
			data = JSON.parse(data);
			if(data.status === 'success'){
				$('#transferalert').css('color','green');
				$('#transferalert').html('Funds Successfully Transfered');

				window.location = `${baseurl}index.php/${data.msg}`;
			}else if(data.status === 'error'){
				$('#transferalert').css('color','red');
				$('#transferalert').html(data.msg);
			}
		},
		error: function(error){
			console.log(error);
		}
	});
});

//ADD Expense
$('#expenseform').on('submit', function(e){
	e.preventDefault();
	formData = $('#expenseform').serialize();

	$.ajax({
		url: baseurl+'index.php/Accounts/addexpense',
		type: 'POST',
		data: formData,
		success: function(data){
			data = JSON.parse(data);
			if(data.status === 'success'){
				$('#responsealert').css('color','green');
				$('#responsealert').html('Expense Successfully Added');

				window.location = `${baseurl}index.php/${data.msg}`;

			}else if(data.status === 'error'){
				$('#responsealert').css('color','red');
				$('#responsealert').html(data.msg);
			} 
		},
		error: function(error){
			console.log(error);
		}
	})
});


//Add Expense Modal Hidden
$('#addexpense').on('hidden.bs.modal', function () {
    
    $('#expenseform').trigger("reset");
    $('#responsealert').css('color','black');
	$('#responsealert').html('');
});


//Account Changed
$('#accountchange').on('change',function(e){
    e.preventDefault();
    account = $('#accountchange').val();
    if(account === 'all'){

        $.ajax({
        	url: baseurl+'index.php/Report/all',
        	type: 'POST',
        	success: function(data){
        		data = JSON.parse(data);
        		if(data.status === 'success'){
        			accounts = data.accounts;
        			//All Accounts Data
        			assetshtml = `<div style="padding:30px;margin-top:20px;">`;
        			expenseshtml = `<div style="padding:30px;margin-top:20px;">`;

        			allassettotal = 0;
        			allexpensestotal = 0;

        			for (var i = 0; i < accounts.length; i++) {
        				
        				account = accounts[i].account;
        				//Assets
        				assets = account.Assets;
        				if(!assets.Cash){
    						assets.Cash = 0;
    					}

    					if(!assets.Inventory){
    						assets.Inventory = 0;
    					}

    					//Assets
        				assestotal = parseInt(assets.Cash) + parseInt(assets.Inventory);
        				allassettotal += parseInt(assestotal);
        				assetshtml += `
        					<div class="asset col-md-12">
                                <a href="javascript:;"><label style="float:left;"><i class="fa fa-plus" onclick="action = this.classList[1];
            if(action === 'fa-plus'){
                $(this).removeClass('fa-plus');
                $(this).addClass('fa-minus');
                $('#asset${i}').show();
            }else if(action === 'fa-minus'){
                $(this).addClass('fa-plus');
                $(this).removeClass('fa-minus');
                $('#asset${i}').hide();
            }"></i>&nbsp;&nbsp;&nbsp;${accounts[i].station}</label></a>
                                <label class="amount" style="float:right;">$ ${assestotal}</label>
                                <div class="row" id="asset${i}" style="padding:30px; display:none;">
                                    <div class="asset col-md-12">
                                        <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;Cash</label>
                                        <label class="amount" style="float:right;">$ ${assets.Cash}</label>
                                    </div>

                                    <div class="asset col-md-12">
                                        <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;Inventory</label>
                                        <label class="amount" style="float:right;">$ ${assets.Inventory}</label>
                                    </div>
                                </div>
                            </div>
        				`;
        				

        				//Expenses
        				expenses = account.Expenses;
        				if(!expenses){
    						expenses = [];
    					}

    					//Expense Details
    					expensedetail = ``;
    					expensetotal = 0;
    					for (var x = 0; x < expenses.length; x++) {
    						expensetotal += parseInt(expenses[x].amount);
    						expensedetail += `
    							<div class="expense col-md-12">
                                    <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;${expenses[x].type}</label>
                                    <label class="amount" style="float:right;">$ ${expenses[x].amount}</label>
                                </div>
    						`;
    					};

    					expenseshtml += `
    						<div class="expense col-md-12">
                                <a href="javascript:;"><label style="float:left;"><i class="fa fa-plus" onclick="action = this.classList[1];
            if(action === 'fa-plus'){
                $(this).removeClass('fa-plus');
                $(this).addClass('fa-minus');
                $('#expense${i}').show();
            }else if(action === 'fa-minus'){
                $(this).addClass('fa-plus');
                $(this).removeClass('fa-minus');
                $('#expense${i}').hide();
            }"></i>&nbsp;&nbsp;&nbsp;${accounts[i].station}</label></a>
                                <label class="amount" style="float:right;">$ ${expensetotal}</label>
                                	<!-- Expense Details -->
                                    <div class="row" id="expense${i}" style="padding:30px; display:none;">
    					`;

    					expenseshtml += expensedetail; 

    					expenseshtml += `
    							</div>
                            </div>
    					`;

    					allexpensestotal += parseInt(expensetotal);

        			};
        			//Assets Html
        			assetshtml += `
        				<div class="total col-md-12" style="margin-top:90px; border-top:2px solid;" >
                            <label style="float:left;">&nbsp;&nbsp;&nbsp;<b>Total</b></label>
                            <label class="amount" style="float:right;"><b>$ ${allassettotal}</b></label>
                        </div>
        			</div>`;

        			//Expense Html
        			expenseshtml += `
        			
        				<div class="total col-md-12" style="margin-top:90px; border-top:2px solid;">
                            <label style="float:left;"><!-- <i class="fa fa-plus"></i> -->&nbsp;&nbsp;&nbsp;<b>Total</b></label>
                            <label class="amount" style="float:right;"><b>$ ${allexpensestotal}</b></label>
                        </div>
                    </div>    
        			`;

        			//Assets HTML
        			$('#singleasset').html(assetshtml);
        			//Expense Html
        			$('#singleexpense').html(expenseshtml);

        		}else if(data.status === 'error'){
        			console.log(data.msg);
        		}
        	},
        	error: function(error){
        		console.log(error);
        	}
        })


    }else if(account !== ''){

    	$.ajax({
    		url: baseurl+'index.php/Report/singleAccount',
    		type: 'POST',
    		data: {id: account},
    		success: function(data){
    			data = JSON.parse(data);
    			if(data.status === 'success'){
    				data = data.account;
    				assets = data.Assets;
    				expenses = data.Expenses;

    				if(!assets.Cash){
    					assets.Cash = 0;
    				}

    				if(!assets.Inventory){
    					assets.Inventory = 0;
    				}

    				if(!expenses){
    					expenses = [];
    				}


    				//Adding Assets
    				sum = parseInt(assets.Cash) + parseInt(assets.Inventory);

    				//Assets View
    				assetshtml = `
    					
                            <div style="padding:30px;margin-top:20px;" >
                                <div class="asset col-md-12">
                                    <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;Cash</label>
                                    <label class="amount" style="float:right;">$ ${assets.Cash}</label>
                                </div>

                                <div class="asset col-md-12">
                                    <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;Inventory</label>
                                    <label class="amount" style="float:right;">$ ${assets.Inventory}</label>
                                </div>

                            </div>

                            <div class="total col-md-12" style="margin-top:90px; border-top:2px solid;" >
                                <label style="float:left;">&nbsp;&nbsp;&nbsp;<b>Total</b></label>
                                <label class="amount" style="float:right;"><b>$ ${sum}</b></label>
                            </div>
                        `;

                    $('#singleasset').html(assetshtml);    

                    //Expenses View
                    expenseshtml = `
                    	<div style="padding:30px;margin-top:20px;">`;
                    sum = 0;
                    	for(i = 0; i < expenses.length; i++){
                    		sum += parseInt(expenses[i].amount);
                    		expenseshtml += `
                    			<div class="expense col-md-12">
                                    <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;${expenses[i].type}</label>
                                    <label class="amount" style="float:right;">$ ${expenses[i].amount}</label>
                                </div>
                    		`;

                    	}
                                    
                                    
                    expenseshtml += `           
            
                        </div>

                            <div class="total col-md-12" style="margin-top:90px; border-top:2px solid;">
                                <label style="float:left;">&nbsp;&nbsp;&nbsp;<b>Total</b></label>
                                <label class="amount" style="float:right;"><b>$ ${sum}</b></label>
                            </div>
                    `;

                    $('#singleexpense').html(expenseshtml);


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

