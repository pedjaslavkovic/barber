<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coiffeur Cristian Termin</title>
<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/bootstrap.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>

<style>
.not-approved {
    background-color: red !important;
}
</style>

</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out</a>
    </p>




<div class="container">
      <div class="">
        <h1>Coiffeur Cristian Termin</h1>
        <div class="col-sm-8" style=" padding-left: 0px; padding-right: 0px;">
		<div class="well clearfix">
			<div class="pull-right"><button type="button" class="btn btn-xs btn-primary" id="command-add" data-row-id="0">
			<span class="glyphicon glyphicon-plus"></span> Neu Termin</button></div></div>
		<table id="employee_grid" class="table table-condensed table-hover table-striped" width="100%" cellspacing="0" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="id" width="3%" class="text-left" data-type="numeric" data-identifier="true">Id</th>
					<th data-column-id="name" width="12%">Name</th>
					<th data-column-id="email" width="8%">Email</th>
					<th data-column-id="geburtstag" width="10%">Geburtstag</th>
					<th data-column-id="nummer" width="10%">Nummer</th>
					<th data-column-id="adresse" width="10%">Adresse</th>
					<th data-column-id="termindatum" width="10%">Termin Datum</th>
					<th data-column-id="terminzeit">Termin Zeit</th>
					<th data-column-id="service1" width="12%">Service 1</th>
					<th data-column-id="service2">Service 2</th>
					<th data-column-id="service3">Service 3</th>
					<th data-column-id="useri">User</th>
					<th data-column-id="approved" width="10%">Approved</th>
					<th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
				</tr>
			</thead>
		</table>
    </div>
      </div>
    </div>
	
<div id="add_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
        <script>
            
             $('#add_model').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
})
          
            
        </script>
        	
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Neu Termin</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_add">
				<input type="hidden" value="add" name="action" id="action">
                  <div class="form-group">
                    <label for="name" class="control-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name"/>
                  </div>
                  <div class="form-group">
                    <label for="email" class="control-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email"/>
                  </div>
				  <div class="form-group">
                    <label for="geburtstag" class="control-label">Geburtstag:</label>
                    <input type="date" class="form-control" id="geburtstag" name="geburtstag"/>
                  </div>
                  <div class="form-group">
                    <label for="nummer" class="control-label">Nummer:</label>
                    <input type="text" class="form-control" id="nummer" name="nummer"/>
                  </div>
                   <div class="form-group">
                    <label for="adresse" class="control-label">Adresse:</label>
                    <input type="text" class="form-control" id="adresse" name="adresse"/>
                  </div>
                   <div class="form-group">
                    <label for="termindatum" class="control-label">Termin Datum:</label>
                    <input type="date" class="form-control" id="termindatum" name="termindatum"/>
                  </div>
               
                  <div class="form-group">
                       <label for="terminzeit" class="control-label">Termin Zeit: </label>
                   <select class="selectpicker" id="terminzeit" name="terminzeit">
                 <option>10:00</option>
                 <option>10:15</option>
                 <option>11:00</option>
                 <option>11:15</option>
                 <option>12:00</option>
                 <option>12:15</option>
                 <option>13:00</option>
                 <option>13:15</option>
                 <option>14:00</option>
                 <option>14:15</option>
                 <option>15:00</option>
                 <option>16:00</option>
                 <option>16:15</option>
                 <option>17:00</option>
                 <option>17:15</option>
                </select>
                  </div>
                  <div class="form-group">
                       <label for="service1" class="control-label">Service 1: </label>
                     <select class="selectpicker" id="service1" name="service1">
                          <option></option>
                          <option>Ansatz Färben</option>
                          <option>Neu Färben</option>
                          <option>Tönung</option>
                          <option>Waschen/Schneiden/Stylen.</option>
                          <option>Balayage Lang./Blondierung + Farbe + Schneiden </option>
                          <option>Balayage Mittel Lang./Blondierung + Farbe + Schneiden</option>
                          <option>Balayage Kurz / Blondierung + Farbe + Föhnen + Schneiden</option>
                          <option>Färben Kurzhaar</option>
                          <option>60 Strähnen - Medium volume (Extensions)</option>
                          <option>100 Strähnen - Big volume (Extensions)</option>  
                          <option>180 Strähnen - Max volume (Extensions)</option>
                    
                  </select>
                  </div>
                         





                
                 <div class="form-group">
                       <label for="service2" class="control-label">Service 2: </label>
                     <select class="selectpicker" id="service2" name="service2">
                          <option></option>
                           <option>Ansatz Färben</option>
                          <option>Neu Färben</option>
                          <option>Tönung</option>
                          <option>Waschen/Schneiden/Stylen.</option>
                          <option>Balayage Lang./Blondierung + Farbe + Schneiden </option>
                          <option>Balayage Mittel Lang./Blondierung + Farbe + Schneiden</option>
                          <option>Balayage Kurz / Blondierung + Farbe + Föhnen + Schneiden</option>
                          <option>Färben Kurzhaar</option>
                          <option>60 Strähnen - Medium volume (Extensions)</option>
                          <option>100 Strähnen - Big volume (Extensions)</option>  
                          <option>180 Strähnen - Max volume (Extensions)</option>
                  </select>
                  </div>
                 <div class="form-group">
                       <label for="service3" class="control-label">Service 3: </label>
                     <select class="selectpicker" id="service3" name="service3">
                          <option></option>
                       <option>Ansatz Färben</option>
                          <option>Neu Färben</option>
                          <option>Tönung</option>
                          <option>Waschen/Schneiden/Stylen.</option>
                          <option>Balayage Lang./Blondierung + Farbe + Schneiden </option>
                          <option>Balayage Mittel Lang./Blondierung + Farbe + Schneiden</option>
                          <option>Balayage Kurz / Blondierung + Farbe + Föhnen + Schneiden</option>
                          <option>Färben Kurzhaar</option>
                          <option>60 Strähnen - Medium volume (Extensions)</option>
                          <option>100 Strähnen - Big volume (Extensions)</option>  
                          <option>180 Strähnen - Max volume (Extensions)</option>
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="useri" class="control-label">User:</label>
                    <input type="text" value="Cristian" class="form-control" id="useri" name="useri"/>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_add" class="btn btn-primary">Save</button>
            </div>
            
            
          
            
            
			</form>
        </div>
    </div>
</div>
<div id="edit_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Termin</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_edit">
				<input type="hidden" value="edit" name="action" id="action">
				<input type="hidden" value="0" name="edit_id" id="edit_id">
                 <div class="form-group">
                    <label for="name" class="control-label">Name:</label>
                    <input type="text" class="form-control" id="edit_name" name="edit_name"/>
                  </div>
                  <div class="form-group">
                    <label for="email" class="control-label">Email:</label>
                    <input type="text" class="form-control" id="edit_email" name="edit_email"/>
                  </div>
				  <div class="form-group">
                    <label for="geburtstag" class="control-label">Geburtstag:</label>
                    <input type="date" class="form-control" id="edit_geburtstag" name="edit_geburtstag"/>
                  </div>
                  <div class="form-group">
                    <label for="nummer" class="control-label">Nummer:</label>
                    <input type="text" class="form-control" id="edit_nummer" name="edit_nummer"/>
                  </div>
                   <div class="form-group">
                    <label for="adresse" class="control-label">Adresse:</label>
                    <input type="text" class="form-control" id="edit_adresse" name="edit_adresse"/>
                  </div>
                   <div class="form-group">
                    <label for="termindatum" class="control-label">Termin Datum:</label>
                    <input type="date" class="form-control" id="edit_termindatum" name="edit_termindatum"/>
                  </div>
                 <div class="form-group">
                       <label for="edit_terminzeit" class="control-label">Termin Zeit: </label>
                   <select class="selectpicker" id="edit_terminzeit" name="edit_terminzeit">
                  <option>10:00</option>
                 <option>10:15</option>
                 <option>11:00</option>
                 <option>11:15</option>
                 <option>12:00</option>
                 <option>12:15</option>
                 <option>13:00</option>
                 <option>13:15</option>
                 <option>14:00</option>
                 <option>14:15</option>
                 <option>15:00</option>
                 <option>16:00</option>
                 <option>16:15</option>
                 <option>17:00</option>
                 <option>17:15</option>
                </select>
                  </div>
                   <div class="form-group">
                       <label for="service1" class="control-label">Service 1: </label>
                     <select class="selectpicker" id="edit_service1" name="edit_service1">
                          <option></option>
                            <option>Ansatz Färben</option>
                          <option>Neu Färben</option>
                          <option>Tönung</option>
                          <option>Waschen/Schneiden/Stylen.</option>
                          <option>Balayage Lang./Blondierung + Farbe + Schneiden </option>
                          <option>Balayage Mittel Lang./Blondierung + Farbe + Schneiden</option>
                          <option>Balayage Kurz / Blondierung + Farbe + Föhnen + Schneiden</option>
                          <option>Färben Kurzhaar</option>
                          <option>60 Strähnen - Medium volume (Extensions)</option>
                          <option>100 Strähnen - Big volume (Extensions)</option>  
                          <option>180 Strähnen - Max volume (Extensions)</option>
                  </select>
                  </div>
                  <div class="form-group">
                       <label for="service2" class="control-label">Service 2: </label>
                     <select class="selectpicker" id="edit_service2" name="edit_service2">
                          <option></option>
                           <option>Ansatz Färben</option>
                          <option>Neu Färben</option>
                          <option>Tönung</option>
                          <option>Waschen/Schneiden/Stylen.</option>
                          <option>Balayage Lang./Blondierung + Farbe + Schneiden </option>
                          <option>Balayage Mittel Lang./Blondierung + Farbe + Schneiden</option>
                          <option>Balayage Kurz / Blondierung + Farbe + Föhnen + Schneiden</option>
                          <option>Färben Kurzhaar</option>
                          <option>60 Strähnen - Medium volume (Extensions)</option>
                          <option>100 Strähnen - Big volume (Extensions)</option>  
                          <option>180 Strähnen - Max volume (Extensions)</option>
                  </select>
                  </div>
                   <div class="form-group">
                       <label for="service3" class="control-label">Service 3: </label>
                     <select class="selectpicker" id="edit_service3" name="edit_service3">
                          <option></option>
                           <option>Ansatz Färben</option>
                          <option>Neu Färben</option>
                          <option>Tönung</option>
                          <option>Waschen/Schneiden/Stylen.</option>
                          <option>Balayage Lang./Blondierung + Farbe + Schneiden </option>
                          <option>Balayage Mittel Lang./Blondierung + Farbe + Schneiden</option>
                          <option>Balayage Kurz / Blondierung + Farbe + Föhnen + Schneiden</option>
                          <option>Färben Kurzhaar</option>
                          <option>60 Strähnen - Medium volume (Extensions)</option>
                          <option>100 Strähnen - Big volume (Extensions)</option>  
                          <option>180 Strähnen - Max volume (Extensions)</option>
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="useri" class="control-label">User:</label>
                    <input type="text" class="form-control" id="edit_useri" name="edit_useri"/>
                  </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_edit" class="btn btn-primary">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
$( document ).ready(function() {
	var grid = $("#employee_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "response.php",
		formatters: {
		        "commands": function(column, row) {
		            console.log(row.approved);
        var buttons = "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + 
            "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";

        // If the row isn't approved yet, add an 'Approve' button
        if (row.approved == "0") {
            buttons += " <button type=\"button\" class=\"btn btn-xs btn-default command-approve\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-ok\"></span></button>";
        }else{
            buttons += " <button type=\"button\" class=\"btn btn-xs btn-default command-remove\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-remove\"></span></button>";
        }

        return buttons;
    }
		    }
   }).on("loaded.rs.jquery.bootgrid", function()
{
    
    /* Executes after data is loaded and rendered */
    grid.find(".command-edit").on("click", function(e)
    {
        //alert("You pressed edit on row: " + $(this).data("row-id"));
			var ele =$(this).parent();
			var g_id = $(this).parent().siblings(':first').html();
            var g_name = $(this).parent().siblings(':nth-of-type(2)').html();
console.log(g_id);
                    console.log(g_name);

		//console.log(grid.data());//
		$('#edit_model').modal('show');
					if($(this).data("row-id") >0) {
							
                                // collect the data
                                $('#edit_id').val(ele.siblings(':first').html()); // in case we're changing the key
                                $('#edit_name').val(ele.siblings(':nth-of-type(2)').html());
                                $('#edit_email').val(ele.siblings(':nth-of-type(3)').html());
                                $('#edit_geburtstag').val(ele.siblings(':nth-of-type(4)').html());
                                  $('#edit_nummer').val(ele.siblings(':nth-of-type(5)').html());
                                $('#edit_adresse').val(ele.siblings(':nth-of-type(6)').html());
                                $('#edit_termindatum').val(ele.siblings(':nth-of-type(7)').html());
                                $('#edit_terminzeit').val(ele.siblings(':nth-of-type(8)').html());
                                $('#edit_service1').val(ele.siblings(':nth-of-type(9)').html());
                                $('#edit_service2').val(ele.siblings(':nth-of-type(10)').html());
                                $('#edit_service3').val(ele.siblings(':nth-of-type(11)').html());
                                  $('#edit_useri').val(ele.siblings(':nth-of-type(12)').html());
					} else {
					 alert('Now row selected! First select row, then click edit button');
					}
    }).end().find(".command-delete").on("click", function(e)
    {
	
		var conf = confirm('Delete id: ' + $(this).data("row-id") + ' termin?');
					alert(conf);
                    if(conf){
                                $.post('response.php', { id: $(this).data("row-id"), action:'delete'}
                                    , function(){
                                        // when ajax returns (callback), 
										$("#employee_grid").bootgrid('reload');
                                }); 
								//$(this).parent('tr').remove();
								//$("#employee_grid").bootgrid('remove', $(this).data("row-id"))
                    }
    }).end().find(".command-approve").on("click", function(e) {
    var id = $(this).data("row-id");

    // Confirm before approving
    var conf = confirm('Approve id: ' + id + ' termin?');
    if(conf){
        $.post('response.php', { id: id, action:'approve'}, function(){
            // when ajax returns (callback), 
            $("#employee_grid").bootgrid('reload');
        }); 
    }
}).end().find(".command-remove").on("click", function(e) {
    var id = $(this).data("row-id");

    // Confirm before approving
    var conf = confirm('Remove id: ' + id + ' termin?');
    if(conf){
        $.post('response.php', { id: id, action:'remove'}, function(){
            // when ajax returns (callback), 
            $("#employee_grid").bootgrid('reload');
        }); 
    }
});
});

function ajaxAction(action) {
				data = $("#frm_"+action).serializeArray();
				$.ajax({
				  type: "POST",  
				  url: "response.php",  
				  data: data,
				  dataType: "json",       
				  success: function(response)  
				  {
					$('#'+action+'_model').modal('hide');
					$("#employee_grid").bootgrid('reload');
				  }   
				});
			}
			
			$( "#command-add" ).click(function() {
			  $('#add_model').modal('show');
			
			  
			});
			$( "#btn_add" ).click(function() {
			  ajaxAction('add');
			 
			});
			$( "#btn_edit" ).click(function() {
			  ajaxAction('edit');
			});
});
</script>
