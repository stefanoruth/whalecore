@extends('app') @section('body')
<section class="hero is-success is-fullheight">
	<div class="hero-body">
		<div class="container has-text-centered">
			<div class="column is-4 is-offset-4">
				<h3 class="title has-text-grey">Register</h3>
				<div class="box">
					<figure class="avatar">
						<img class="image is-96x96" src="{{ asset('hvalborg.png') }}">
					</figure>
					<form method="post" action="{{ route('register') }}">
                      {{ csrf_field() }}
						<div class="field">
							<div class="control">
								<input class="input is-large {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" placeholder="Your Name" autofocus=""> 
                             	@if($errors->has('name'))
								<p class="help is-danger">{{ $errors->first('name') }}</p>
								@endif
							</div>
						</div>
						<div class="field">
							<div class="control">
								<input class="input is-large {{ $errors->has('email') ? 'is-danger' : '' }}" type="email" name="email" placeholder="Your Email">
                                @if($errors->has('email'))
								<p class="help is-danger">{{ $errors->first('email') }}</p>
								@endif
							</div>
						</div>
						<div class="field">
							<div class="control">
								<input class="input is-large {{ $errors->has('password') ? 'is-danger' : '' }}" type="password" name="password" placeholder="Your Password">
                                @if($errors->has('password'))
								<p class="help is-danger">{{ $errors->first('password') }}</p>
								@endif
							</div>
						</div>
						<div class="field">
							<div class="control">
								<input class="input is-large {{ $errors->has('password_confirmation') ? 'is-danger' : '' }}" type="password" name="password_confirmation" placeholder="Confirm your Password">
                                @if($errors->has('password_confirmation'))
								<p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
								@endif
							</div>
						</div>
						<button type="submit" class="button is-block is-info is-large">Create</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@stop