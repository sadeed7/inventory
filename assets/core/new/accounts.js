

//Funds Transfer
$('#transferform').on('submit', function (e) {
    e.preventDefault();
    formData = $('#transferform').serialize();

    $.ajax({
        url: baseurl + 'index.php/Accounts/transfer',
        type: 'POST',
        data: formData,
        success: function success(data) {
            data = JSON.parse(data);
            if (data.status === 'success') {
                $('#transferalert').css('color', 'green');
                $('#transferalert').html('Funds Successfully Transfered');

                window.location = baseurl + 'index.php/' + data.msg;
            } else if (data.status === 'error') {
                $('#transferalert').css('color', 'red');
                $('#transferalert').html(data.msg);
            }
        },
        error: function error(_error) {
            console.log(_error);
        }
    });
});

//ADD Expense
$('#expenseform').on('submit', function (e) {
    e.preventDefault();
    formData = $('#expenseform').serialize();

    $.ajax({
        url: baseurl + 'index.php/Accounts/addexpense',
        type: 'POST',
        data: formData,
        success: function success(data) {
            data = JSON.parse(data);
            if (data.status === 'success') {
                $('#responsealert').css('color', 'green');
                $('#responsealert').html('Expense Successfully Added');

                window.location = baseurl + 'index.php/' + data.msg;
            } else if (data.status === 'error') {
                $('#responsealert').css('color', 'red');
                $('#responsealert').html(data.msg);
            }
        },
        error: function error(_error2) {
            console.log(_error2);
        }
    });
});

//Add Expense Modal Hidden
$('#addexpense').on('hidden.bs.modal', function () {

    $('#expenseform').trigger("reset");
    $('#responsealert').css('color', 'black');
    $('#responsealert').html('');
});

//Account Changed
$('#accountchange').on('change', function (e) {
    e.preventDefault();
    account = $('#accountchange').val();
    if (account === 'all') {

        $.ajax({
            url: baseurl + 'index.php/Report/all',
            type: 'POST',
            success: function success(data) {
                data = JSON.parse(data);
                if (data.status === 'success') {
                    accounts = data.accounts;
                    //All Accounts Data
                    assetshtml = '<div style="padding:30px;margin-top:20px;">';
                    expenseshtml = '<div style="padding:30px;margin-top:20px;">';

                    allassettotal = 0;
                    allexpensestotal = 0;

                    for (var i = 0; i < accounts.length; i++) {

                        account = accounts[i].account;
                        //Assets
                        assets = account.Assets;
                        if (!assets.Cash) {
                            assets.Cash = 0;
                        }

                        if (!assets.Inventory) {
                            assets.Inventory = 0;
                        }

                        //Assets
                        assestotal = parseInt(assets.Cash) + parseInt(assets.Inventory);
                        allassettotal += parseInt(assestotal);
                        assetshtml += '\n        \t\t\t\t\t<div class="asset col-md-12">\n                                <a href="javascript:;"><label style="float:left;"><i class="fa fa-plus" onclick="action = this.classList[1];\n            if(action === \'fa-plus\'){\n                $(this).removeClass(\'fa-plus\');\n                $(this).addClass(\'fa-minus\');\n                $(\'#asset' + i + '\').show();\n            }else if(action === \'fa-minus\'){\n                $(this).addClass(\'fa-plus\');\n                $(this).removeClass(\'fa-minus\');\n                $(\'#asset' + i + '\').hide();\n            }"></i>&nbsp;&nbsp;&nbsp;' + accounts[i].station + '</label></a>\n                                <label class="amount" style="float:right;">$ ' + assestotal + '</label>\n                                <div class="row" id="asset' + i + '" style="padding:30px; display:none;">\n                                    <div class="asset col-md-12">\n                                        <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;Cash</label>\n                                        <label class="amount" style="float:right;">$ ' + assets.Cash + '</label>\n                                    </div>\n\n                                    <div class="asset col-md-12">\n                                        <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;Inventory</label>\n                                        <label class="amount" style="float:right;">$ ' + assets.Inventory + '</label>\n                                    </div>\n                                </div>\n                            </div>\n        \t\t\t\t';

                        //Expenses
                        expenses = account.Expenses;
                        if (!expenses) {
                            expenses = [];
                        }

                        //Expense Details
                        expensedetail = '';
                        expensetotal = 0;
                        for (var x = 0; x < expenses.length; x++) {
                            expensetotal += parseInt(expenses[x].amount);
                            expensedetail += '\n    \t\t\t\t\t\t\t<div class="expense col-md-12">\n                                    <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;' + expenses[x].type + '</label>\n                                    <label class="amount" style="float:right;">$ ' + expenses[x].amount + '</label>\n                                </div>\n    \t\t\t\t\t\t';
                        };

                        expenseshtml += '\n    \t\t\t\t\t\t<div class="expense col-md-12">\n                                <a href="javascript:;"><label style="float:left;"><i class="fa fa-plus" onclick="action = this.classList[1];\n            if(action === \'fa-plus\'){\n                $(this).removeClass(\'fa-plus\');\n                $(this).addClass(\'fa-minus\');\n                $(\'#expense' + i + '\').show();\n            }else if(action === \'fa-minus\'){\n                $(this).addClass(\'fa-plus\');\n                $(this).removeClass(\'fa-minus\');\n                $(\'#expense' + i + '\').hide();\n            }"></i>&nbsp;&nbsp;&nbsp;' + accounts[i].station + '</label></a>\n                                <label class="amount" style="float:right;">$ ' + expensetotal + '</label>\n                                \t<!-- Expense Details -->\n                                    <div class="row" id="expense' + i + '" style="padding:30px; display:none;">\n    \t\t\t\t\t';

                        expenseshtml += expensedetail;

                        expenseshtml += '\n    \t\t\t\t\t\t\t</div>\n                            </div>\n    \t\t\t\t\t';

                        allexpensestotal += parseInt(expensetotal);
                    };
                    //Assets Html
                    assetshtml += '\n        \t\t\t\t<div class="total col-md-12" style="margin-top:90px; border-top:2px solid;" >\n                            <label style="float:left;">&nbsp;&nbsp;&nbsp;<b>Total</b></label>\n                            <label class="amount" style="float:right;"><b>$ ' + allassettotal + '</b></label>\n                        </div>\n        \t\t\t</div>';

                    //Expense Html
                    expenseshtml += '\n        \t\t\t\n        \t\t\t\t<div class="total col-md-12" style="margin-top:90px; border-top:2px solid;">\n                            <label style="float:left;"><!-- <i class="fa fa-plus"></i> -->&nbsp;&nbsp;&nbsp;<b>Total</b></label>\n                            <label class="amount" style="float:right;"><b>$ ' + allexpensestotal + '</b></label>\n                        </div>\n                    </div>    \n        \t\t\t';

                    //Assets HTML
                    $('#singleasset').html(assetshtml);
                    //Expense Html
                    $('#singleexpense').html(expenseshtml);
                } else if (data.status === 'error') {
                    console.log(data.msg);
                }
            },
            error: function error(_error3) {
                console.log(_error3);
            }
        });
    } else if (account !== '') {

        $.ajax({
            url: baseurl + 'index.php/Report/singleAccount',
            type: 'POST',
            data: { id: account },
            success: function success(data) {
                data = JSON.parse(data);
                if (data.status === 'success') {
                    data = data.account;
                    assets = data.Assets;
                    expenses = data.Expenses;

                    if (!assets.Cash) {
                        assets.Cash = 0;
                    }

                    if (!assets.Inventory) {
                        assets.Inventory = 0;
                    }

                    if (!expenses) {
                        expenses = [];
                    }

                    //Adding Assets
                    sum = parseInt(assets.Cash) + parseInt(assets.Inventory);

                    //Assets View
                    assetshtml = '\n    \t\t\t\t\t\n                            <div style="padding:30px;margin-top:20px;" >\n                                <div class="asset col-md-12">\n                                    <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;Cash</label>\n                                    <label class="amount" style="float:right;">$ ' + assets.Cash + '</label>\n                                </div>\n\n                                <div class="asset col-md-12">\n                                    <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;Inventory</label>\n                                    <label class="amount" style="float:right;">$ ' + assets.Inventory + '</label>\n                                </div>\n\n                            </div>\n\n                            <div class="total col-md-12" style="margin-top:90px; border-top:2px solid;" >\n                                <label style="float:left;">&nbsp;&nbsp;&nbsp;<b>Total</b></label>\n                                <label class="amount" style="float:right;"><b>$ ' + sum + '</b></label>\n                            </div>\n                        ';

                    $('#singleasset').html(assetshtml);

                    //Expenses View
                    expenseshtml = '\n                    \t<div style="padding:30px;margin-top:20px;">';
                    sum = 0;
                    for (i = 0; i < expenses.length; i++) {
                        sum += parseInt(expenses[i].amount);
                        expenseshtml += '\n                    \t\t\t<div class="expense col-md-12">\n                                    <label style="float:left;"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;' + expenses[i].type + '</label>\n                                    <label class="amount" style="float:right;">$ ' + expenses[i].amount + '</label>\n                                </div>\n                    \t\t';
                    }

                    expenseshtml += '           \n            \n                        </div>\n\n                            <div class="total col-md-12" style="margin-top:90px; border-top:2px solid;">\n                                <label style="float:left;">&nbsp;&nbsp;&nbsp;<b>Total</b></label>\n                                <label class="amount" style="float:right;"><b>$ ' + sum + '</b></label>\n                            </div>\n                    ';

                    $('#singleexpense').html(expenseshtml);
                } else if (data.status === 'error') {
                    console.log(data.msg);
                }
            },
            error: function error(_error4) {
                console.log(_error4);
            }
        });
    }
});