<?php
	session_start();
	require('app/init.php');

	if(!isset($_SESSION['loggedIn_'.APP_NAME]) || $_SESSION['loggedIn_'.APP_NAME] != "true") {
		header('location: login.php');
		exit;
	}
	if (isset($_GET["logout"])) {
		session_destroy();
		header('location: login.php');
		exit;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?=APP_NAME?> Leads History</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="http://apoxymedia.com/hrm/admin/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="http://apoxymedia.com/hrm/admin/assets/css/ready.css">
	<link rel="stylesheet" href="http://apoxymedia.com/hrm/admin/assets/css/demo.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<style type="text/css">
		i{
			font-size: 20px !important;
			
			color: blue;
		}
		.la-remove{
			color: red;
		}
		a{
			text-decoration: none !important;
		}
		.logo{
			text-decoration: none !important;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="index.php" class="logo">
					<img src="http://apoxymedia.com/images/web_logo.png" width="100">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="http://apoxymedia.com/hrm/admin/assets/img/profile.jpg" alt="user-img" width="36" class="img-circle"><span >Hello, User</span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<a class="dropdown-item" href="?logout=true"><i class="fa fa-power-off"></i> Logout</a>
							</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>			
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<ul class="nav">
						<li class="nav-item">
							<a href="#">
								<p>========</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#">
								<p>=====</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#">
								<p>===========</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="#">
								<p>===</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?logout=true">
								<p>=====</p>
							</a>
						</li>
						
					</ul>
				</div>
			</div>			
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title"><?=APP_NAME?> | Dashboard</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="panel">
											<h4>Download Report</h4>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>From</label>
														<input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date" required="" /> 
														
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>To</label>
														<input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<button style="    margin-top: 25px;" id="filter" class="btn btn-primary">Filter</button>
														<a style="  margin-top: 25px;" class="btn btn-primary" href="#" data-toggle="modal" data-target="#upload_modal" >Upload</a>
														<button style="  margin-top: 25px;" id="download_report" class="btn btn-primary">Download</button>
														
														
													</div>
												</div>
											</div>
											
										</div>
										
									</div>
									<div class="card-body table-responsive">
										<table id="example" class="table table-hover ">
											<div id="loading" class="text-center">
												<img style="width: 20%" src="https://cdn-images-1.medium.com/max/1600/0*4Gzjgh9Y7Gu8KEtZ.gif">
											</div>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--  starting of model -->
				<div class="modal fade" id="upload_modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-md" role="document">
                      	<div class="modal-content w3-center">
                          	<div class="modal-body" style="    min-height: 383px;">
                          		<h3>Upload Data</h3>
                          		<div id="upload_loading" class="text-center">
									<img style="width: 15%" src="https://cdn-images-1.medium.com/max/1600/0*4Gzjgh9Y7Gu8KEtZ.gif" >
								</div>
		                        <form action="backend/upload.php" method="POST" enctype="multipart/form-data" class="form">
		                        	<div class="form-group">
		                        		<input class="form-control" type="file" name="file" id="file">
		                        	</div>
		                        	<input type="hidden" name="upload_data_file" value="true">
		                        	<div class="form-group">
		                        		<input class="form-control btn btn-block btn-primary" type="submit" name="upload_data" value="Upload">
		                        	</div>
		                        </form>
	                      	</div>
                      	</div>
                    </div>
                </div>
				<!-- ending of model -->
			</div>
		</div>
	</div>
</div>

</body>
<script src="http://apoxymedia.com/hrm/admin/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="http://apoxymedia.com/hrm/admin/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="http://apoxymedia.com/hrm/admin/assets/js/core/popper.min.js"></script>
<script src="http://apoxymedia.com/hrm/admin/assets/js/core/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://www.aspsnippets.com/demos/scripts/table2excel.js"></script>
<script type="text/javascript" class="init">
	
$(document).ready(function() {
	
	filter_data();

	$('').ready(function(){
		$('#upload_loading').hide(); 
		$('.form').on('submit', function(e){
			$('#upload_loading').show(); 
			//stop submitting the form to see the disabled button effect
	        e.preventDefault();
			$form = $(this);
			
			$.ajax({
				url : $form.attr('action'),
				method : $form.attr('method'),
				data:  new FormData(this),
		        contentType: false,
		        cache: false,
		        processData:false,
				success : function(response){
					response = $.parseJSON(response);
					if(response.success) {
						alert(response.message);

					} else{
						alert(response.message);
					}
					$('#upload_loading').hide();
					//$('#draft-btn').removeAttr("disabled");
					
				}
							
			});

		});
		
	});


    $('#filter').click(function(){ 
    	$('#loading').show(); 
    	 //$('#example').DataTable().destroy();
         filter_data();         
    }); 	

    $('#download_report').click(function(){  
        	$("#example").table2excel({
		    exclude: ".noExl",
		    name: "Worksheet 1",
		    filename: "Report_"+Math.random().toString(36).replace('0.', '')
		});

    }); 

    
    
    function filter_data() {
   		//$('#example').DataTable();  
   		var from_date = $('#from_date').val();  
        var to_date = $('#to_date').val();  
        var action= "filter";
        $.ajax({  
              url:"backend/fetch.php",  
              method:"POST",  

              data:{from_date:from_date, to_date:to_date, action: action},  
              success:function(data)  
              {  
          			$('#loading').hide();
                   	$('#example').html(data);
                   

              }  
        });   
   }

   function submitForm($form) {
	
	
	}




});
	</script>
</html>
