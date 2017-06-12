/* ------------------------------------------------------------------------------
 *
 *  # Google Visualization - stacked columns
 *
 *  Google Visualization stacked column chart demonstration
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */


// Stacked columns
// ------------------------------

// Initialize chart
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawColumnStacked);


// Chart settings
function drawColumnStacked() {

    // Data
    var data = google.visualization.arrayToDataTable([
        ['Analysis', 'Stock', 'Profit', { role: 'annotation' } ],
        ['Station 1', 1000, 300, ''],
        ['Station 2', 1000, 100, ''],
        ['Station 3', 3000, 300,  ''],
        ['Station 4', 800, 200,  ''],
        ['Station 5', 5000, 500,  ''],
        
    ]);


    // Options
    var options_column_stacked = {
        fontName: 'Roboto',
        height: 400,
        fontSize: 12,
        chartArea: {
            left: '5%',
            width: '90%',
            height: 350
        },
        bar: {groupWidth: "30%"},
        series: {
        0:{color:'#ADC2EB'},
        1:{color:'#9FD5A3'},
    
        },
        isStacked: true,
        tooltip: {
            textStyle: {
                fontName: 'Roboto',
                fontSize: 13
            }
        },
        vAxis: {
            title: 'Analysis',
            titleTextStyle: {
                fontSize: 13,
                italic: false
            },
            gridlines:{
                color: '#e5e5e5',
                count: 10
            },
            minValue: 0
        },

        legend: {
            position: 'top',
            alignment: 'center',
            textStyle: {
                fontSize: 12
            }
        }
    };

    // Draw chart
    var column_stacked = new google.visualization.ColumnChart($('#google-column-stacked')[0]);
    column_stacked.draw(data, options_column_stacked);
}


// Resize chart
// ------------------------------

$(function () {

    // Resize chart on sidebar width change and window resize
    $(window).on('resize', resize);
    $(".sidebar-control").on('click', resize);

    // Resize function
    function resize() {
        drawColumnStacked();
    }
});
