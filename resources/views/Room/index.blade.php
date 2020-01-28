@extends('layouts.layout')

@section('content')
	<!-- Table -->
	<div class="row">
		<div class="col">
		  <div class="card shadow">
		    <div class="card-header border-0">
		      <h3 class="mb-0">Room tables		      	
		      <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add_modal"><i class="fa fa-plus"></i></button>
		      </h3>
		    </div>
		    <div class="table-responsive">
		      <table class="table align-items-center table-flush">
		        <thead class="thead-light">
		          <tr>
		            <th scope="col">Room Name</th>
		            <th scope="col">Extra Bed</th>
		            <th scope="col">Jumlah Kamar</th>
		            <th scope="col">Harga</th>
		            <th scope="col">Action</th>
		          </tr>
		        </thead>
		        <tbody id="tbody">

		        </tbody>
		      </table>
		    </div>
		    <div class="card-footer py-4">
		      <nav aria-label="...">
		        <ul class="pagination justify-content-end mb-0">
		          <li class="page-item disabled">
		            <a class="page-link" href="#" tabindex="-1">
		              <i class="fas fa-angle-left"></i>
		              <span class="sr-only">Previous</span>
		            </a>
		          </li>
		          <li class="page-item active">
		            <a class="page-link" href="#">1</a>
		          </li>
		          <li class="page-item">
		            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
		          </li>
		          <li class="page-item"><a class="page-link" href="#">3</a></li>
		          <li class="page-item">
		            <a class="page-link" href="#">
		              <i class="fas fa-angle-right"></i>
		              <span class="sr-only">Next</span>
		            </a>
		          </li>
		        </ul>
		      </nav>
		    </div>
		  </div>
		</div>
	</div>
	<!-- Add Modal -->
	<form method="POST" id="addroom">		
		<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <div class="form-group">
		        	<label>Room Name</label>
		        	<input type="text" name="room_name" id="room_name" class="form-control" required autofocus>
		        </div>
		        <div class="form-group">
		        	<label>Extra Bed</label>
		        	<input type="number" name="extra_bed" id="extra_bed" class="form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Jumlah Kamar</label>
		        	<input type="number" name="jumlah_kamar" id="jumlah_kamar" class="form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Harga</label>
		        	<input type="number" name="harga" id="harga" class="form-control" required>
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id="submitaddRoom">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>
	</form>
	<!-- Update Modal -->
	<form method="POST" action="" class="users-update-record-model form-horizontal">		
		<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Edit Room</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body" id="updateBody">

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary updateRoom">Update</button>
		      </div>
		    </div>
		  </div>
		</div>
	</form>

	<!-- Delete Modal -->
	<form action="" method="POST" class="users-remove-record-model">
	    <div id="remove-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
	         aria-hidden="true" style="display: none;">
	        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h4 class="modal-title" id="custom-width-modalLabel">Delete</h4>
	                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal"
	                            aria-hidden="true">×
	                    </button>
	                </div>
	                <div class="modal-body">
	                    <p>Are you sure you want to delete this?</p>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary remove-data-from-delete-form"
	                            data-dismiss="modal">Close
	                    </button>
	                    <button type="button" class="btn btn-danger waves-light deleteRecord">Delete
	                    </button>
	                </div>
	            </div>
	        </div>
	    </div>
	</form>

	{{--Firebase Tasks--}}
	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		// Initialize Firebase
	    var config = {
	        apiKey: "{{ config('services.firebase.api_key') }}",
	        authDomain: "{{ config('services.firebase.auth_domain') }}",
	        databaseURL: "{{ config('services.firebase.database_url') }}",
	        storageBucket: "{{ config('services.firebase.storage_bucket') }}",
	    };
	    firebase.initializeApp(config);

	    var database = firebase.database();

	    var lastIndex = 0;

	    // Get Data
	    firebase.database().ref('Room/').on('value', function (snapshot) {
	        var value = snapshot.val();
	        var htmls = [];
	        $.each(value, function (index, value) {
	            if (value) {
	                htmls.push(
	                '<tr>\
		        		<td>' + value.room_name + '</td>\
		        		<td>' + value.extra_bed + '</td>\
		        		<td>' + value.jumlah_kamar + '</td>\
		        		<td>' + value.harga + '</td>\
		        		<td><button data-toggle="modal" data-target="#update_modal" class="btn btn-sm updateData" data-id="' + index + '"><i class="fa fa-edit"></i></button>\
        					<button data-toggle="modal" data-target="#remove-modal" class="btn btn-sm removeData" data-id="' + index + '"><i class="fa fa-trash"></i></button></td>\
	        		</tr>'
	        	);
	            }
	            lastIndex = index;
	        });
	        $('#tbody').html(htmls);
	        $("#submitUser").removeClass('desabled');
	    });

	    // Add Data
	    $('#submitaddRoom').on('click', function () {
	        var values = $("#addroom").serializeArray();
	        var room_name = values[0].value;
	        var extra_bed = values[1].value;
	        var jumlah_kamar = values[2].value;
	        var harga = values[3].value;
	        var userID = values[0].value;

	        console.log(values);

	        firebase.database().ref('Room/' + userID).set({
	            room_name: room_name,
	            extra_bed: extra_bed,
	            jumlah_kamar: jumlah_kamar,
	            harga: harga,
	        });	        
	        swal("Add Success!", "You clicked the button!", "success");
	        // Reassign lastID value
	        lastIndex = userID;
	        $("#addroom input").val("");
	    });

	    // Update Data
	    var updateID = 0;
	    $('body').on('click', '.updateData', function () {
	        updateID = $(this).attr('data-id');
	        firebase.database().ref('Room/' + updateID).on('value', function (snapshot) {
	            var values = snapshot.val();
	            var updateData = 
	            '<div class="form-group">\
			        <label>Room Name</label>\
		            <input id="room_name" type="text" class="form-control" name="room_name" value="' + values.room_name + '">\
			    </div>\
			    <div class="form-group">\
			        <label>Extra Bed</label>\
			        <input id="extra_bed" type="text" class="form-control" name="extra_bed" value="' + values.extra_bed + '">\
			    </div>\
				<div class="form-group">\
			        <label>Jumlah Kamar</label>\
			        <input id="jumlah_kamar" type="number" class="form-control" name="jumlah_kamar" value="' + values.jumlah_kamar + '">\
			    </div>\
			    <div class="form-group">\
			        <label>Harga</label>\
			        <input id="harga" type="number" class="form-control" name="harga" value="' + values.harga + '">\
			    </div>';

	            $('#updateBody').html(updateData);
	        });
	    });

	    $('.updateRoom').on('click', function () {
	        var values = $(".users-update-record-model").serializeArray();
	        var postData = {
	            room_name: values[0].value,
	            extra_bed: values[1].value,
	            jumlah_kamar: values[2].value,
	            harga: values[3].value,
	        };
	        swal("Update Success!", "You clicked the button!", "success");

	        var updates = {};
	        updates['/Room/' + updateID] = postData;

	        firebase.database().ref().update(updates);

	        $("#update_modal").modal('hide');
	    });

	    // Remove Data
	    $("body").on('click', '.removeData', function () {
	        var id = $(this).attr('data-id');
	        $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
	    });

	    $('.deleteRecord').on('click', function () {
	        var values = $(".users-remove-record-model").serializeArray();
	        var id = values[0].value;
	        firebase.database().ref('Room/' + id).remove();
	        swal("Delete Success!", "You clicked the button!", "success");
	        $('body').find('.users-remove-record-model').find("input").remove();
	        $("#remove-modal").modal('hide');
	    });
	    $('.remove-data-from-delete-form').click(function () {
	        $('body').find('.users-remove-record-model').find("input").remove();
	    });
	</script>
@endsection