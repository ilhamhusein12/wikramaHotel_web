@extends('layouts.layout')

@section('content')
	<!-- Table -->
	<div class="row">
		<div class="col">
		  <div class="card shadow">
		    <div class="card-header border-0">
		      <h3 class="mb-0">Booking tables</h3>
		    </div>
		    <div class="table-responsive">
		      <table class="table align-items-center table-flush">
		        <thead class="thead-light">
		          <tr>
		            <th scope="col">No Telephone</th>
		            <th scope="col">Check In</th>
		            <th scope="col">Check Out</th>
		            <th scope="col">Time Booking</th>
		            <th scope="col">Date Booking</th>
		            <th scope="col">Harga Room</th>
		            <th scope="col">Harga Extra Bed</th>
		            <th scope="col">Jumlah Kamar</th>
		            <th scope="col">Total Harga</th>
		            <th scope="col">Status</th>
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

	<form action="" method="POST" class="users-update-record-model">
	    <div id="update_modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
	         aria-hidden="true" style="display: none;">
	        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h4 class="modal-title" id="custom-width-modalLabel">Update</h4>
	                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal"
	                            aria-hidden="true">×
	                    </button>
	                </div>
	                <div class="modal-body">
	                    <p>Are you sure you want to update this?</p>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary remove-data-from-delete-form"
	                            data-dismiss="modal">Close
	                    </button>
	                    <button type="button" class="btn btn-success waves-light updateCheckOut">Check Out
	                    </button>
	                    <button type="button" class="btn btn-success waves-light updateRecord">Update
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
	 //    var ref = firebase.database().ref("Booked/");
		// ref.once("value")
  // 			.then(function(snapshot) {
  //  				var name = snapshot.child("name").val(); // {first:"Ada",last:"Lovelace"}
  //   			var firstName = snapshot.child("name/first").val(); // "Ada"
  //   			var lastName = snapshot.child("name").child("last").val(); // "Lovelace"
  //   			var age = snapshot.child("age").val(); // null
  // 			});

	    firebase.database().ref('Booked/').on('value', function (snapshot) {
	        var value = snapshot.val();
	        var htmls = [];
	        $.each(value, function (index, valueA) {
	        	var idprime = Object.keys(value)[0];
	        	var ind = 0;
	        	$.each(valueA, function(a, value){
	 		       	var idnya = Object.keys(valueA)[ind];
		            if (value) {
		                htmls.push(
			                '<tr>\
				        		<td>' + value.no_telp + '</td>\
				        		<td>' + value.check_in + '</td>\
				        		<td>' + value.check_out + '</td>\
				        		<td>' + value.time_booking + '</td>\
				        		<td>' + value.date_booking + '</td>\
				        		<td>' + value.harga_room + '</td>\
				        		<td>' + value.harga_extra_bed + '</td>\
				        		<td>' + value.jumlah_kamar + '</td>\
				        		<td>' + value.total_harga + '</td>\
				        		<td>' + value.status + '</td>\
				        		<td><button data-toggle="modal" data-target="#update_modal" class="btn btn-sm updateData" data-id="' + idnya + '" data-idprime="' + idprime + '" data-kamar="' + value.jumlah_kamar +'"><i class="fa fa-edit"></i></button>\
		        					<button data-toggle="modal" data-target="#remove-modal" class="btn btn-sm removeData" data-id="' + idnya + '" data-idprime="' + idprime + '"><i class="fa fa-trash"></i></button></td>\
			        		</tr>'
			        	);

			        	ind++;
		            }
	        	});
	            lastIndex = index;
	        });
	        $('#tbody').html(htmls);
	        $("#submitUser").removeClass('desabled');
	    });

	    // Remove Data
	    $("body").on('click', '.removeData', function () {
	        var id = $(this).attr('data-id');
	        var idprime = $(this).attr('data-idprime');
	        $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="' + id + '"><input name="idprime" type="hidden" value="' + idprime + '">');
	    });

	    $("body").on('click', '.updateData', function () {
	        var id = $(this).attr('data-id');
	        var idprime = $(this).attr('data-idprime');
	        var jumlah_kamar = $(this).attr('data-kamar');
	        $('body').find('.users-update-record-model .modal-header').append('<input name="id" type="hidden" value="' + id + '"><input name="idprime" type="hidden" value="' + idprime + '"><input name="kamar" type="hidden" value="' + jumlah_kamar + '">');
	    });

	    $('.deleteRecord').on('click', function () {
	        var values = $(".users-remove-record-model").serializeArray();
	        var data = $('.users-remove-record-model').find("input[name='idprime']").val();
	        var jumlah_kamar = $('.users-update-record-model').find("input[name='kamar']").val();
	        var id = values[0].value;

	    	// Ambil Total Pesanan
	    	firebase.database().ref('Booked/' + data + '/' + id).on('value', function(snapshot){
	    		var value = snapshot.val();
	    		var jumlah_kamar_hapus = value.jumlah_kamar;
	    		sessionStorage.setItem('jumlah_kamar_hapus', jumlah_kamar_hapus);

		    	// Kembalikan nilai kamar menjadi semula
	    		firebase.database().ref('Room/Reguler').on('value', function(snapshot){
	    			var value = snapshot.val();
	    			var total_terakhir_hapus = value.jumlah_kamar;
	    			sessionStorage.setItem('total_terakhir_hapus', total_terakhir_hapus);
	    		});
	    	});

	        firebase.database().ref('Room/Reguler').update({
	        	'jumlah_kamar' : parseInt(parseInt(sessionStorage.getItem('jumlah_kamar_hapus')) + parseInt(sessionStorage.getItem('total_terakhir_hapus')))
	        })

	        sessionStorage.removeItem('total_terakhir_hapus');
	        sessionStorage.removeItem('jumlah_kamar_hapus');

	        firebase.database().ref('Booked/' + data + '/' + id).remove();	

	    	 swal("Delete Success!", "You clicked the button!", "success");

		        
	        $('body').find('.users-update-record-model').find("input").remove();
	        $("#update_modal").modal('hide');
	    });


	    $('.remove-data-from-delete-form').click(function () {
	        $('body').find('.users-remove-record-model').find("input").remove();
	    });

	    $('.updateRecord').on('click', function(){
	    	var values = $('.users-update-record-model').serializeArray();
	    	var data = $('.users-update-record-model').find("input[name='idprime']").val();

	    	var id = values[0].value;
	    	firebase.database().ref('Booked/' + data + '/' + id).update({
	    		'status' : 'Confirmed'
	    	});

			swal("Update Success!", "You clicked the button!", "success");

		        
	        $('body').find('.users-update-record-model').find("input").remove();
	        $("#update_modal").modal('hide');
	    });

		$('.updateCheckOut').on('click', function(){
	    	var values = $('.users-update-record-model').serializeArray();
	    	var data = $('.users-update-record-model').find("input[name='idprime']").val();
	    	var jumlah_kamar = $('.users-update-record-model').find("input[name='kamar']").val();

	    	var id = values[0].value;

	    	// Kembalikan nilai kamar menjadi semula
    		firebase.database().ref('Room/Reguler').on('value', function(snapshot){
    			var value = snapshot.val();
    			var total_terakhir = value.jumlah_kamar;
    			sessionStorage.setItem('total_terakhir', total_terakhir);
    		});


			firebase.database().ref('Room/' + 'Reguler').update({
				'jumlah_kamar' : parseInt(parseInt(sessionStorage.getItem('total_terakhir')) + parseInt(jumlah_kamar))
			});

			sessionStorage.removeItem('total_terakhir');


	    	firebase.database().ref('Booked/' + data + '/' + id).update({
	    		'status' : 'Checked Out',
	    		'jumlah_kamar' : 0
	    	});


	    	 swal("Delete Success!", "You clicked the button!", "success");

		        
	        $('body').find('.users-update-record-model').find("input").remove();
	        $("#update_modal").modal('hide');

	    });	    
	</script>
@endsection