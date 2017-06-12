/* ------------------------------------------------------------------------------
 *
 *  # Google Visualization - stacked area
 *
 *  Google Visualization stacked area chart demonstration
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */


// Stacked area
// ------------------------------

// Initialize chart
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawAreaStackedChart);


// Chart settings
function drawAreaStackedChart() {
    var data;
    if(role === 'seller'){
        data = google.visualization.arrayToDataTable([
            ['Month', station],
            ['Jan',  0],
            ['Feb',  160],
            ['Mar',  230],
            ['Apr',  400],
            ['May',  370],
            ['Jun',  460],
            ['Jul',  400],
            ['Aug',  410],
            ['Sep',  480],
            ['Oct',  550],
            ['Nov',  510],
            ['Dec',  555]
        ]);
    }else{
        data = google.visualization.arrayToDataTable([
            ['Month', 'Station 1', 'Station 2', 'Station 3', 'Station 4', 'Station 5'],
            ['Jan',  0,  0, 0, 0, 0],
            ['Feb',  460,   720, 220, 460, 500],
            ['Mar',  930,  640, 340, 330, 320],
            ['Apr',  1000,  400, 180, 500, 800],
            ['May',  870,  460, 310, 220, 1200],
            ['Jun',  460,   720, 220, 460, 1500],
            ['Jul',  930,  640, 340, 330, 1300],
            ['Aug',  1000,  400, 180, 500, 900],
            ['Sep',  870,  460, 310, 220, 100],
            ['Oct',  460,   720, 220, 460, 150],
            ['Nov',  930,  640, 340, 330, 500],
            ['Dec',  1000,  400, 180, 500, 300]
        ]);
    }

    // Data
    

    // Options
    var options_area_stacked = {
        fontName: 'Roboto',
        height: 400,
        curveType: 'function',
        fontSize: 12,
        areaOpacity: 0.4,
        chartArea: {
            left: '5%',
            width: '90%',
            height: 350
        },
        isStacked: true,
        pointSize: 4,
        tooltip: {
            textStyle: {
                fontName: 'Roboto',
                fontSize: 13
            }
        },
        lineWidth: 1.5,
        vAxis: {
            title: 'Sales',
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
            alignment: 'end',
            textStyle: {
                fontSize: 12
            }
        }
    };

    // Draw chart
    var area_stacked_chart = new google.visualization.AreaChart($('#google-area-stacked')[0]);
    area_stacked_chart.draw(data, options_area_stacked);
}


// Resize chart
// ------------------------------

$(function () {

    // Resize chart on sidebar width change and window resize
    $(window).on('resize', resize);
    $(".sidebar-control").on('click', resize);

    // Resize function
    function resize() {
        drawAreaStackedChart();
    }
});
