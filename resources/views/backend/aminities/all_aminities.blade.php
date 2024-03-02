@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

			<nav class="page-breadcrumb">
				<ol class="breadcrumb">
            <a href="{{ route('add.aminitie') }}" class="btn btn-outline-info">Add Aminities</a>
				</ol>
			</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Aminities All</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>SI</th>
                        <th>Aminities Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($aminities as $key => $item)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->aminities_name }}</td>
                        <td>
            <a href="{{ route('edit.aminitie', $item->id) }}" class="btn btn-outline-warning"> Edit</a>
            <a href="{{ route('delete.aminitie', $item->id) }}" class="btn btn-outline-danger" id="delete"> Delete</a>

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