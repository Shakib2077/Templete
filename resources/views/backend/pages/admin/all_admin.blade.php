@extends('admin.admin_dashboard')
@section('admin')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


<div class="page-content">

			<nav class="page-breadcrumb">
				<ol class="breadcrumb">
            <a href="{{ route('add.admin') }}" class="btn btn-outline-info">Add Admin</a>&nbsp; &nbsp; &nbsp;
				</ol>
			</nav>

			<div class="row">
				<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Admin All</h6>


                <div class="table-responsive">
                  <table id="datatableExample" class="table">
                    <thead>
                      <tr>
                        <th>SI</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($alladmin as $key => $item)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img src="{{ (!empty($item->photo)) ? url('upload/admin_images/'.$item->photo) : url('upload/68470.jpg') }}" style="width:40px; height:50px;"></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>
                        @foreach($item->roles as $role)
                        <span class="badge badge-pill bg-danger">{{ $role->name }}</span>
                        @endforeach
                        </td>

                        <td>

  <a href="{{ route('edit.admin', $item->id) }}" class="btn btn-outline-warning"><i data-feather="edit"></i></a>
  <a href="{{ route('admin.delete.roles', $item->id) }}" class="btn btn-outline-danger" id="delete" title="delete"><i data-feather="trash-2"></i></a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>
		</div>



@endsection