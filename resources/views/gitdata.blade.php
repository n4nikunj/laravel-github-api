<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">

 

   <script src="http://code.jquery.com/jquery-1.12.4.js" type=""></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" ></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
	<div class="row">
		<div class="col-sm-12 col-md-12 text-center" style="
    background-color: #0fadad;
    color: #fff;
    height: 100px;
    font-size: 31px;
    padding-top: 25px;
"> List </div>
		
	</div>
       <div class="row" style="margin-top: 50px;">
		<div class="col-sm-8 col-sm-offset-2 text-center" >
	   <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
              
                <th>Repoid</th>
                <th>Name</th>
                <th>full_name</th>
                <th>html_url</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
               
                <th>Repoid</th>
                <th>Name</th>
                <th>full_name</th>
                <th>html_url</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
		
			@foreach($rows as $val)
		 <?php 
		$repoId = $val->repoId;
		$response = unserialize(base64_decode($val->repoResponse));
		
	   ?>
			<tr>
                
                <td>{{$response['id']}}</td>
                <td>{{$response['name']}}</td>
                <td>{{$response['full_name']}}</td>
                <td>{{$response['html_url']}}</td>
                <td><a href="javascript:void(0)" onclick="getdata({{$response['id']}})">View Full Detail</a></td>
            </tr>
			
			
			@endforeach
		</tbody>
	</table>	
		</div></div>
	   <div class="container">

  <!-- Trigger the modal with a button -->
  <a type="" id="link" class=" btn-lg" data-toggle="modal" data-target="#myModal"></a>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="">
        <div class="modal-header" style=" background-color: #157498;color: #fff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;">Repo Detail</h4>
        </div>
        <div class="modal-body">
			<table class="table">
				
				<tbody>
					<tr>
						
						<th colspan="2">Repoid</th>
						<td id="rid"></td>
					</tr>
					<tr>
						<th colspan="2">Name</th>
						<td id="name"></td>
					</tr><tr>
						<th colspan="2">Full Name</th>
						<td id="full_name"></td>
					</tr>
					<tr>
					<th colspan="3" style="color: #00a6f5;">Owner Detail</th>
					</tr>
					<tr>
						<td></td>
						<th>owner Loinn Name</th>
						<td id="oln"></td>
					</tr>
					<tr>
						<td></td>
						<th>Owner Id</th>
						<td id="oid"></td>
					</tr><tr>
						<td></td>
						<th>Avatar URL</th>
						<td id="avatar_url"></td>
					</tr><tr>
						<td></td>
						<th>type</th>
						<td id="type"></td>
					</tr><tr>
						<td></td>
						<th>Gists URL</th>
						<td id="gists_url"></td>
					</tr><tr>
					
						<th colspan="2">keys_url</th>
						<td id="keys_url"></td>
					</tr><tr>
						<th colspan="2">teams_url</th>
						<td id="teams_url"></td>
					</tr>
					<tr>
						<th colspan="2">events_url</th>
						<td id="events_url"></td>
					</tr>
				
					<tr>
						<th colspan="2">Description</th>
						<td id="dec"></td>
					</tr><tr>
						<th colspan="2">url</th>
						<td id="url"></td>
					</tr><tr>
						<th colspan="2">forks_url</th>
						<td id="forks_url"></td>
					</tr>
						<tr>
						<th colspan="2">Download Url</th>
						<td id="downloads_url"></td>
					</tr>
					<tr>
						<th colspan="2">GIT Url</th>
						<td id="git_url"></td>
					</tr>
					<tr>
						<th colspan="2">SSH Url</th>
						<td id="ssh_url"></td>
					</tr>
					<tr>
						<th colspan="2">Clone Url</th>
						<td id="clone_url"></td>
					</tr>
					<tr>
						<th colspan="2">SVN Url</th>
						<td id="svn_url"></td>
					</tr>
					
				</tbody>
			</table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
	<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );


function getdata(id){
	
	$.ajax({
		type : "GET",
		url : "http://localhost:8000/view/"+id,
		dataType: "json",
		success : function(response) {
			$('#rid').html(response.id);
			$('#name').html(response.name);
			$('#full_name').html(response.full_name);
			$('#oln').html(response.owner.login);
			$('#oid').html(response.owner.id);
			$('#avatar_url').html(response.owner.avatar_url);
			$('#type').html(response.owner.type);
			$('#gists_url').html(response.owner.gists_url);
			$('#html_url').html(response.html_url);
			$('#dec').html(response.description);
			$('#forks_url').html(response.forks_url);
			$('#keys_url').html(response.keys_url);
			$('#teams_url').html(response.teams_url);
			$('#events_url').html(response.events_url);
			$('#downloads_url').html(response.downloads_url);
			$('#git_url').html(response.git_url);
			$('#ssh_url').html(response.ssh_url);
			$('#clone_url').html(response.clone_url);
			$('#svn_url').html(response.svn_url);
			$('#url').html(response.url);
		$('#link').click();	
		}
	});
}	
	</script>
    </body>
</html>
