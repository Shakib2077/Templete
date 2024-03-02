@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">

        <div class="row profile-body">


          <!-- left wrapper end -->
          <!-- middle wrapper start -->
          <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
            <div class="card">
              <div class="card-body">

			<h6 class="card-title">Add Aminities</h6>

			<form id="myForm" method="POST" action="{{ route('store.aminitie') }}" class="forms-sample">
                  @csrf

				<div class="form-group mb-3">
					<label for="exampleInputName" class="form-label">Aminities Name</label>
					<input type="text" name="aminities_name" class="form-control">
                    @error('aminities_name')
                    <span class="text-danger">{{ $message}}</span>
                    @enderror
				</div>

					<button type="submit" class="btn btn-primary me-2">Save Changes</button>
				</form>

              </div>
            </div>
            </div>
         </div>

        </div>

	</div>

    <script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                aminities_name: {
                    required : true,
                },

            },
            messages :{
                aminities_name: {
                    required : 'Please Enter Aminities Name',
                },


            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>


@endsection