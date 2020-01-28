@extends('layouts.layout')

@section('content')
	<div class="row">
		<div class="col-xl-3 col-lg-6">
			<a href="{{ URL('room') }}">				
		      <div class="card card-stats mb-4 mb-xl-0">
		        <div class="card-body">
		          <div class="row">
		            <div class="col">
		              <h5 class="card-title text-uppercase text-muted mb-0">Room</h5>
		            </div>
		            <div class="col-auto">
		              <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
		                <i class="ni ni-spaceship"></i>
		              </div>
		            </div>
		          </div>
		          <p class="mt-3 mb-0 text-muted text-sm">
		            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> Room</span>
		            <span class="text-nowrap">View room</span>
		          </p>
		        </div>
		      </div>
			</a>
	    </div>
		<div class="col-xl-3 col-lg-6">
			<a href="{{ URL('user') }}">
				<div class="card card-stats mb-4 mb-xl-0">
			        <div class="card-body">
			          <div class="row">
			            <div class="col">
			              <h5 class="card-title text-uppercase text-muted mb-0">User</h5>
			            </div>
			            <div class="col-auto">
			              <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
			                <i class="fas fa-user"></i>
			              </div>
			            </div>
			          </div>
			          <p class="mt-3 mb-0 text-muted text-sm">
			            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> User</span>
			            <span class="text-nowrap">View user</span>
			          </p>
			        </div>
			    </div>
			</a>
	    </div>
		<div class="col-xl-3 col-lg-6">
			<a href="{{ URL('booking') }}">
				<div class="card card-stats mb-4 mb-xl-0">
			        <div class="card-body">
			          <div class="row">
			            <div class="col">
			              <h5 class="card-title text-uppercase text-muted mb-0">Booking</h5>
			            </div>
			            <div class="col-auto">
			              <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
			                <i class="fas fa-list"></i>
			              </div>
			            </div>
			          </div>
			          <p class="mt-3 mb-0 text-muted text-sm">
			            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> Booking</span>
			            <span class="text-nowrap">View booking</span>
			          </p>
			        </div>
			    </div>
			</a>
	    </div>
		<div class="col-xl-3 col-lg-6">
			<a href="{{ URL('admin') }}">
				<div class="card card-stats mb-4 mb-xl-0">
			        <div class="card-body">
			          <div class="row">
			            <div class="col">
			              <h5 class="card-title text-uppercase text-muted mb-0">Admin</h5>
			            </div>
			            <div class="col-auto">
			              <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
			                <i class="fas fa-user"></i>
			              </div>
			            </div>
			          </div>
			          <p class="mt-3 mb-0 text-muted text-sm">
			            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> Admin</span>
			            <span class="text-nowrap">View admin</span>
			          </p>
			        </div>
			    </div>
			</a>
	    </div>
	</div>  
@endsection