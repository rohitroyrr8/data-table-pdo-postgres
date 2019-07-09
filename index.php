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
	<link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
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
		.form-control {
			padding: 0px;
		}
		.filter-label {
			margin-top: 15px;
		}
		select.form-control:not([size]):not([multiple]) {
			height: 26px;
		} 
		option {
			min-height: 7px;
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
						<a style="float: right" class="btn btn-primary" href="#" data-toggle="modal" data-target="#upload_modal" >Upload Data</a>
						<h4 class="page-title"><?=APP_NAME?> | Dashboard</h4>

						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="panel">
											<div style="width: 500px">
												<h4>Filter Report</h4>
												
													<div class="row">
													<div class="col-md-4">
														<label class="filter-label">Search Query</label>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input type="text" name="searchQuery" id="searchQuery" class="form-control">
														</div>
													</div>
													<div class="col-md-4">
														<label class="filter-label">Select Column</label>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<select class="form-control" name="searchColumn" id="searchColumn">
																<option value="email">Email</option>
																<option value="location">Location</option>
															</select>
														</div>
													</div>
													<div class="col-md-4">
														<label class="filter-label">Order BY</label>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<select class="form-control" name="orderColumn" id="orderColumn">
																<option selected="" value="ID">ID</option>
																
															</select>
														</div>
													</div>
													<div class="col-md-4">
														<label class="filter-label">Order Direction</label>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<select class="form-control" name="orderDirection" id="orderDirection">
																<option value="ASC">Ascending</option>
																<option value="DESC">Descending</option>
															</select>
														</div>
													</div>
													<div class="col-md-4"></div>
													<div class="col-md-8">
														<div class="form-group">
															<button style="    margin-top: 25px;" id="filter" class="btn btn-primary form-control">Filter</button>
														</div>
													</div>
													</div>
												
											</div>
										</div>
										
									</div>
									<div class="card-body table-responsive">
										<div id="loading" class="text-center">
											<img style="width: 8%" src="https://cdn-images-1.medium.com/max/1600/0*4Gzjgh9Y7Gu8KEtZ.gif">
										</div>
										<div class="row">
										<div class="col-md-10">
											<table id="example" class="table table-hover ">
												
											</table>
										</div>
										<div class="col-md-2">
											<div style="float:right">
												<a id="downloadFilterData"><i class="fa fa-download" style="font-size: 25px"></i></a>
											</div>
										</div>	
										</div>
										
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
					$('#loading').show(); 
			    	filter_data();
					
					
				}
							
			});

		});
		
	});


    $('#filter').click(function(){ 
    	$('#loading').show(); 
    	 //$('#example').DataTable().destroy();
         filter_data();         
    }); 	

    $('#downloadFilterData').click(function(){
    	$('#loading').show();
    	download_filter_data();
    });
  	
  	function download_filter_data() {
  		var orderDirection = $('#orderDirection').val();
        var orderColumn = $('#orderColumn').val();
        var searchColumn = $('#searchColumn').val();
        var searchQuery= $('#searchQuery').val();

        var action = "custom_download";

        $.ajax({
        	url:"backend/download.php",
        	method:"POST",  
        	data:{searchQuery:searchQuery, searchColumn:searchColumn, orderColumn:orderColumn, orderDirection:orderDirection, action:action},  
        	success:function(data)  
            {  
      			$('#loading').hide();
               	window.location = data;
            }  
        });
  	}

    function filter_data() {
   		//$('#example').DataTable();  
   		//var from_date = $('#from_date').val();  
        //var to_date = $('#to_date').val();  
        var orderDirection = $('#orderDirection').val();
        var orderColumn = $('#orderColumn').val();
        var searchColumn = $('#searchColumn').val();
        var searchQuery= $('#searchQuery').val();

        var action= "filter";
        $.ajax({  
              url:"backend/fetch.php",  
              method:"POST",  

          	  data:{searchQuery:searchQuery, searchColumn:searchColumn, orderColumn:orderColumn, orderDirection:orderDirection, action:action},  
              success:function(data)  
              {  
          			$('#loading').hide();
                   	$('#example').html(data);
                   

              }  
        });   
   }

  

});
	</script>
</html>
