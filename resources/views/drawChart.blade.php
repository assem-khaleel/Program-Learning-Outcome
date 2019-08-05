<div id="indicators-chart">

</div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>

@if(!empty($currentRubric))
         // Bar chart
         var options = {
             chart: {
                 height: 350,
                 type: 'bar',
                 options : 'cf',
             },

             plotOptions: {
                 bar: {
                     horizontal: true,
                 }
             },
             dataLabels: {
                 enabled: false
             },
             series: [{
                 data: [@foreach($rubricLevels as $rubricLevel) '{{$rubricLevel->percentage}}' , @endforeach]
             }],
             xaxis: {
                 categories: [@foreach($currentRubric->rubricIndicators as $rubricIndicator)'{{$rubricIndicator->indicator}}',@endforeach],
             }
         }
         var chart = new ApexCharts(
             document.querySelector("#indicators-chart"),
             options
         );

         chart.render();

@endif
    </script>
