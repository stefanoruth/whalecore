@extends('app') @section('body')
<section class="hero is-success is-fullheight">
	<div class="hero-body">
		<div class="container has-text-centered">
			<div class="column is-4 is-offset-4">
				<h3 class="title has-text-grey">Login</h3>
				<div class="box">
					<figure class="avatar">
						<img class="image is-96x96" src="{{ asset('hvalborg.png') }}">
					</figure>
					<form method="post" action="{{ route('login') }}">
						{{ csrf_field() }}
						<div class="field">
							<div class="control">
								<input class="input is-large {{ $errors->has('email') ? 'is-danger' : '' }}" type="email" name="email" placeholder="Your Email" autofocus=""> 
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
						<button type='submit' class="button is-block is-primary is-large">Login</a>
					</form>
				</div>
				<p class="has-text-grey">
					<a href="{{ route('register') }}">Sign Up</a> &nbsp;·&nbsp;
				</p>
			</div>
		</div>
	</div>
</section>
@stop