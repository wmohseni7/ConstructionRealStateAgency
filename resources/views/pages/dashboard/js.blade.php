<script src={{ asset('assets/plugins/chart.js/chart.min.js') }}></script>
<script src="{{ asset('assets/plugins/chart.js/highcharts.js') }}"></script>
<script>


    var users =  {{ json_encode($users) }};
 
    Highcharts.chart('container', {
        title: {
            text: 'رشد پروژه در هر ماه'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'تعداد پروژه های هر ماه'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: ' تعداد پروژه ',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>