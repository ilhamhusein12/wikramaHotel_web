@extends('layouts.layout')

@section('content')
	<!-- Table -->
	<div class="row">
		<div class="col">
		  <div class="card shadow">
		    <div class="card-header border-0">
		      <h3 class="mb-0">User tables		      	
		      <!-- <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add_modal"><i class="fa fa-plus"></i></button> -->
		      </h3>
		    </div>
		    <div class="table-responsive">
		      <table class="table align-items-center table-flush">
		        <thead class="thead-light">
		          <tr>
		            <th scope="col">Name</th>
		            <th scope="col">Email</th>
		            <th scope="col">No Telephone</th>
		            <th scope="col">Password</th>
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
		            <a class="page-link" href="#">2<span class="sr-only">(current)</span></a>
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

	<!-- Update Modal -->
	<form method="POST" action="" class="users-update-record-model form-horizontal">		
		<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body" id="updateBody">

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary updateUser">Update</button>
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
	    firebase.database().ref('Users/').on('value', function (snapshot) {
	        var value = snapshot.val();
	        var htmls = [];
	        $.each(value, function (index, value) {
	            if (value) {
	                htmls.push(
	                '<tr>\
		        		<td>' + value.nama + '</td>\
		        		<td>' + value.email + '</td>\
		        		<td>' + value.no_telp + '</td>\
		        		<td>' + value.password + '</td>\
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

	    // Update Data
	    var updateID = 0;
	    $('body').on('click', '.updateData', function () {
	        updateID = $(this).attr('data-id');
	        firebase.database().ref('Users/' + updateID).on('value', function (snapshot) {
	            var values = snapshot.val();
	            var updateData = 
	            '<div class="form-group">\
			        <label>Name</label>\
		            <input id="nama" type="text" class="form-control" name="nama" value="' + values.nama + '">\
			    </div>\
			    <div class="form-group">\
			        <label>Email</label>\
			        <input id="email" type="email" class="form-control" name="email" value="' + values.email + '">\
			    </div>\
				<div class="form-group">\
			        <label>No Telephone</label>\
			        <input id="no_telp" type="number" class="form-control" name="no_telp" value="' + values.no_telp + '">\
			    </div>\
			    <div class="form-group">\
			        <label>Password</label>\
			        <input id="password" type="text" class="form-control" name="password" value="' + values.password + '">\
			    </div>';

	            $('#updateBody').html(updateData);
	        });
	    });

	    $('.updateUser').on('click', function () {
	        var values = $(".users-update-record-model").serializeArray();
	        var postData = {
	            nama: values[0].value,
	            email: values[1].value,
	            no_telp: values[2].value,
	            password: values[3].value,
	        };
	        swal("Update Success!", "You clicked the button!", "success");

	        var updates = {};
	        updates['/Users/' + updateID] = postData;

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
	        firebase.database().ref('Users/' + id).remove();
	        swal("Delete Success!", "You clicked the button!", "success");
	        $('body').find('.users-remove-record-model').find("input").remove();
	        $("#remove-modal").modal('hide');
	    });
	    $('.remove-data-from-delete-form').click(function () {
	        $('body').find('.users-remove-record-model').find("input").remove();
	    });
	</script>

@endsection