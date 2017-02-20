@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-2">
                                                            <input type="text" placeholder="First Name" class="form-control" name="fname" value="{{ old('fname') }}">
							</div>
                                                        <div class="col-md-2">
                                                            <input type="text" placeholder="Middle Name" class="form-control" name="mname" value="{{ old('mname') }}">
							</div>
                                                        <div class="col-md-2">
								<input type="text" placeholder ="Last Name" class="form-control" name="lname" value="{{ old('lname') }}">
							</div>
						</div>
                                                
                                                <div class="form-group">
         
                                                  <label class="col-md-4 control-label">Date of Birth</label>
                                                    <div class="col-md-2">
                                                        <input type="text" placeholder="1990-01-30" name="birthdate">
                                                    </div>  
                                                  <label class="col-md-2 control-label">Gender</label>
                                                    <div class="col-md-2">
                                                        <select name="gender" class="form form-control">
                                                            <option value="M">Male</option>
                                                            <option value="F">Female</option>
                                                        </select>    
                                                    </div>  
                                                </div>
                                                
                           
                                                <div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}"required="required">
							</div>
						</div>
                                                
                                                <div class="form-group">
							<label class="col-md-4 control-label">Address 1</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addr1" value="{{ old('addr1') }}"required="required">
							</div>
						</div>
                                                
                                                <div class="form-group">
							<label class="col-md-4 control-label">Address 2</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addr2" value="{{ old('addr2') }}"required="required">
							</div>
                                                </div>
                                                
                                                <div class="form-group">
							<label class="col-md-4 control-label">City/Municipality</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="city" value="{{ old('city') }}"required="required">
							</div>
						</div>
			
                                                
                                                <div class="form-group">
							<label class="col-md-4 control-label">Province</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="state" value="{{ old('state') }}"required="required">
							</div>
						</div>
                                                <div class="form-group">
							<label class="col-md-4 control-label">Country</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="country" value="{{ old('country') }}"required="required">
							</div>
						</div>
                                                
                                                <div class="form-group">
							<label class="col-md-4 control-label">Zip</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="zip" value="{{ old('zip') }}" required="required">
							</div>
						</div>
                                                
                                                <div class="form-group">
							<label class="col-md-4 control-label">Phone Number</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="phone" value="{{ old('phone') }}"required="required">
							</div>
						</div>
                                                
                                                <div class="form-group">
							<label class="col-md-4 control-label">Mobile Number</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}"required="required">
							</div>
						</div>
                                                
						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password"required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation"required="required">
							</div>
						</div>

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Not a robot?</label>
                                                    <div class="col-md-6">
                                                        
                                                        {!! app('captcha')->display(); !!}
                                                    </div>    
                                                </div>    
						<div class="form-group">
                                                   
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
           
@endsection
