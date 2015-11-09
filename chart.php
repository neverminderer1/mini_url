<?php require_once 'src/Redirect/Tools/Datasourse.php'; ?>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      google.setOnLoadCallback(drawRegionsMap);
      function drawChart() {
        var dataBrowser = google.visualization.arrayToDataTable(<?php echo $browser ?>);
        var dataDevice = google.visualization.arrayToDataTable(<?php echo $device ?>);
        var dataOs = google.visualization.arrayToDataTable(<?php echo $os ?>);
        var optionsBrowser = {title: 'Clicks per browser'};
        var optionsDevice = {title: 'Clicks per device'};
        var optionsOs = {title: 'Clicks per os'};
        var browser = new google.visualization.PieChart(document.getElementById('browser'));
        var device = new google.visualization.PieChart(document.getElementById('devise'));
        var os = new google.visualization.PieChart(document.getElementById('os'));
        browser.draw(dataBrowser, optionsBrowser);
        device.draw(dataDevice, optionsDevice);
        os.draw(dataOs, optionsOs);
      }
      
      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable(<?php echo $geo ?>);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="regions_div"></div>
    <div id="os"></div>
    <div id="browser"></div>
    <div id="devise"></div>
  </body>
</html>