@extends('master')

@section('body')
<div class="flex justify-center items-center h-screen bg-grey-light">
	<div class="w-full max-w-sm sm:px-8">
		<form class="bg-primary rounded px-8 pt-6 pb-8 mb-4 text-white " method="post" action="{{ route('register') }}">
			{{ csrf_field() }}
			<div class="flex justify-center mb-6 pt-8">
				<div class="bg-white rounded-full p-2">
					<img class="w-24 h-24" src="{{ asset('logo.png') }}" alt="Whalecore Logo">
				</div>
			</div>

			<div class="text-center mb-4">Enter your login credentails<br>to get access:</div>

			<label class="field">
				<input type="text" class="apperance-none border-b py-2 w-full bg-primary text-white" name="name" placeholder="Name" autofocus value="{{ old('name') }}">
				@if($errors->has('name'))
					<p class="text-red-dark text-xs italic mt-1">{{ $errors->first('name') }}</p>
				@endif
			</label>

			<label class="field">
				<input type="text" class="apperance-none border-b py-2 w-full bg-primary text-white" name="email" placeholder="Email" value="{{ old('email') }}">
				@if($errors->has('email'))
					<p class="text-red-dark text-xs italic mt-1">{{ $errors->first('email') }}</p>
				@endif
			</label>

			<label class="field">
				<input type="password" class="apperance-none border-b py-2 w-full bg-primary text-white" name="password" placeholder="Password">
				@if($errors->has('password'))
					<p class="text-red-dark text-xs italic mt-1">{{ $errors->first('password') }}</p>
				@endif
			</label>

			<label class="field">
				<input type="password" class="apperance-none border-b py-2 w-full bg-primary text-white" name="password_confirmation" placeholder="Repeat password">
				@if($errors->has('password_confirmation'))
					<p class="text-red-dark text-xs italic mt-1">{{ $errors->first('password_confirmation') }}</p>
				@endif
			</label>

			<button class="btn-white py-2 font-bold w-full mt-2 uppercase mb-4" type="submit">Sign up</button>

			<div class="text-center mb-4 text-grey-light">
				<span>Do you have an account?</span>
				<a class="text-white no-underline" href="{{ route('login') }}">Login</a>
			</div>
		</form>
		<p class="text-center text-grey-dark text-xs">©{{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
	</div>
</div>
@stop