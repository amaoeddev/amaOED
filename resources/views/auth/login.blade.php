@extends('app')

@section('content')
<div class="container">
	<div class="row">
		 <div class="col-md-6">
		<h1 style ="color:#a30606">Why enroll in an Online Course at AMA University</h1>
                <ul>
               <li> <strong>Study anytime, anywhere </strong> With our online programs, you can study in the comfort of your own house, in the cozy ambience of coffee shops, or really anywhere you want.You even travel around the world while studying!</li>
               <li> <strong>Learn from real-life case studies</strong>  Our industry lecturers of businessmen, experts, and scientists would gladly share their knowledge and answer your questions through our forums and seminars.</li>
               <li> <strong>Reputable Professors</strong>  Learn from the best AMA University professors</li>
               <li> <strong>Reasonable tuition fee</strong>   Acquiring a Bachelor’s Degree doesn’t have to be so expensive anymore.</li>
               <li> <strong>Free Learning Materials</strong>  Books can be expensive, but with our program, you could access all learning materials online for free!</li>
               <li> <strong> All day help-desk</strong>  Ask your questions anytime of the day and we’ll get back to you within 48 hours.</li>
               </ul>
               
               <a href="{{ url('/auth/register') }}" class="form-control btn btn-primary" type="button">Register now at AMA Online Education</a>
               
               </div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
                                                            
								<button type="submit" class="btn btn-primary">Login</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
