<?php
	
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		define('DB_SERVER', 'localhost');
		define('DB_USERNAME', 'root');
		define('DB_PASSWORD', '');
		define('DB_DATABASE', 'fydp');
	
		$db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

		
		if ($db->connect_error) {
		  die("Connection failed: " . $db->connect_error);
		}
		
		$stmt = $db->prepare("SELECT time, ac_p FROM collected");
		$stmt->execute();
		$result = $stmt->get_result();
		$row1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
		$count1 = mysqli_num_rows($result);
		
		//print_r($row1);
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid" style="margin-top: 25px;">

                    <!-- Page Heading -->
					
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
						<h1 class="h3 mb-0 font-weight-bold text-gray-800">Design and Analysis of Renewable Energy based Electric Vehicle Charging Station (EVCS)</h1>
					</div>
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 font-weight-bold text-gray-800">ATC 1 Group 1 EEE400C</h1>
						
                    </div>

                    <!-- Content Row -->
                    <div class="row">
					
						
						
						
						<!-- Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Solar Panel Voltage</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="pvv"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solar-panel fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Solar Panel Current</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="pvi"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solar-panel fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Solar Panel Power Output</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="pvp"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solar-panel fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                EV Charger Voltage</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="outv"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bolt fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                EV Charger Current</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="outi"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bolt fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                EV Charger Power Output</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="outp"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bolt fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						
						

                        <!-- Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Grid Voltage</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="acv"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-plug fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Current draw from Grid</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="aci"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-plug fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Power draw from Grid</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="acp"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-plug fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Energy taken from Grid</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="ace"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-plug fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Grid Frequency</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="acf"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-plug fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Power Factor</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="acpf"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-plug fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						
						
						
						
						
						
						
						
						

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Solar Panel Power Output on Nov 11, 2022</h6>
                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                
                                <!-- Card Body -->
                                
                            </div>
                        </div>
						
                    </div>

                    <!-- Content Row --
                    <div class="row">

                        <!-- Content Column --
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example --
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Color System --
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations --
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="...">
                                    </div>
                                    <p>Add some quality, svg illustrations to your project courtesy of <a
                                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                        constantly updated collection of beautiful svg images that you can use
                                        completely free and without attribution!</p>
                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                        unDraw &rarr;</a>
                                </div>
                            </div>

                            <!-- Approach --
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
                                </div>
                            </div>

                        </div>
                    </div>-->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
	// Set new default font family and font color to mimic Bootstrap's default styling
	Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#858796';

	function number_format(number, decimals, dec_point, thousands_sep) {
	  // *     example: number_format(1234.56, 2, ',', ' ');
	  // *     return: '1 234,56'
	  number = (number + '').replace(',', '').replace(' ', '');
	  var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
		  var k = Math.pow(10, prec);
		  return '' + Math.round(n * k) / k;
		};
	  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	  if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	  }
	  if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	  }
	  return s.join(dec);
	}

	// Area Chart Example
	var ctx = document.getElementById("myAreaChart");
	var myLineChart = new Chart(ctx, {
	  type: 'line',
	  data: {
		labels: [
		<?php
			for($i = 0; $i < $count1; $i++) {
				echo '"' . date("h:i A", intval($row1[$i]["time"] * 3600 - 3600)) . '", ';
			}
		?>
		],
		datasets: [{
			data: [
			<?php
				for($i = 0; $i < $count1; $i++) {
					echo $row1[$i]["ac_p"] . ", ";
				}
			?>
			],
		  label: "Power",
		  lineTension: 0.3,
		  backgroundColor: "rgba(78, 115, 223, 0.05)",
		  borderColor: "rgba(78, 115, 223, 1)",
		  pointRadius: 3,
		  pointBackgroundColor: "rgba(78, 115, 223, 1)",
		  pointBorderColor: "rgba(78, 115, 223, 1)",
		  pointHoverRadius: 3,
		  pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
		  pointHoverBorderColor: "rgba(78, 115, 223, 1)",
		  pointHitRadius: 10,
		  pointBorderWidth: 2,
		}],
	  },
	  options: {
		maintainAspectRatio: false,
		layout: {
		  padding: {
			left: 10,
			right: 25,
			top: 25,
			bottom: 0
		  }
		},
		scales: {
		  xAxes: [{
			time: {
			  unit: 'date'
			},
			gridLines: {
			  display: false,
			  drawBorder: false
			},
			ticks: {
			  maxTicksLimit: 7
			}
		  }],
		  yAxes: [{
			ticks: {
			  maxTicksLimit: 5,
			  padding: 10,
			  // Include a dollar sign in the ticks
			  callback: function(value, index, values) {
				return number_format(value) + "W";
			  }
			},
			gridLines: {
			  color: "rgb(234, 236, 244)",
			  zeroLineColor: "rgb(234, 236, 244)",
			  drawBorder: false,
			  borderDash: [2],
			  zeroLineBorderDash: [2]
			}
		  }],
		},
		legend: {
		  display: false
		},
		tooltips: {
		  backgroundColor: "rgb(255,255,255)",
		  bodyFontColor: "#858796",
		  titleMarginBottom: 10,
		  titleFontColor: '#6e707e',
		  titleFontSize: 14,
		  borderColor: '#dddfeb',
		  borderWidth: 1,
		  xPadding: 15,
		  yPadding: 15,
		  displayColors: false,
		  intersect: false,
		  mode: 'index',
		  caretPadding: 10,
		  callbacks: {
			label: function(tooltipItem, chart) {
			  var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
			  return datasetLabel + ': ' + tooltipItem.yLabel + 'W';
			}
		  }
		}
	  }
	});
	
	
	</script>
    <!--<script src="js/demo/chart-pie-demo.js"></script>-->
	
	<script>
		function call_grid() {
			<?php
				if(isset($_GET['mobile'])) {
					//echo 'fetch ("http://6f3a07213c08.sn.mynetname.net:8013/solarserver/last/")';
					echo 'fetch ("http://192.168.145.234:8013/solarserver/last/")';
				}
				else {
					echo 'fetch ("http://localhost:8013/solarserver/last/")';
				}
			?>
			//fetch ("http://localhost:8013/solarserver/last/")
			.then(response => response.json())
			.then(result => {
				
				document.getElementById("outv").innerHTML = (result["out_v"] > 0 ? result["out_v"].toFixed(2) : "0.00") + " V";
				document.getElementById("outi").innerHTML = (result["out_i"] > 0 ? result["out_i"].toFixed(2) : "0.00") + " A";
				
				document.getElementById("outp").innerHTML = (result["out_v"]*result["out_i"] > 0 ? (result["out_v"]*result["out_i"]).toFixed(2) : "0.00") + " W";
				
				document.getElementById("pvv").innerHTML = (result["pv_out_v"] > 0 ? result["pv_out_v"].toFixed(2) : "0.00") + " V";
				document.getElementById("pvi").innerHTML = (result["pv_out_i"] > 0 ? result["pv_out_i"].toFixed(2) : "0.00") + " A";
				
				document.getElementById("pvp").innerHTML = (result["pv_out_v"]*result["pv_out_i"] > 0 ? (result["pv_out_v"]*result["pv_out_i"]).toFixed(2) : "0.00") + " W";
				
				document.getElementById("acv").innerHTML = result["ac_v"].toFixed(2) + " V";
				document.getElementById("aci").innerHTML = result["ac_i"].toFixed(2) + " A";
				document.getElementById("acp").innerHTML = result["ac_p"].toFixed(2) + " W";
				document.getElementById("ace").innerHTML = result["ac_e"].toFixed(2) + " kWh";
				document.getElementById("acf").innerHTML = result["ac_f"].toFixed(2) + " Hz";
				document.getElementById("acpf").innerHTML = result["ac_pf"].toFixed(2);
			});
		}
		call_grid();
		var timerID = setInterval(call_grid, 1000);
		//clearInterval(timerID);
	</script>
	
	<style>
		.fa-solar-panel {
			color: #e74a3b;
		}
		.fa-bolt {
			color: #1cc88a;
		}
		.fa-plug {
			color: #4e73df;
		}
	</style>

</body>

</html>