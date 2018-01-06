@extends('master')

@section('body')
	<div class="flex justify-center items-center h-screen bg-grey-light">
		<div class="w-full max-w-xs">
			<form class="bg-white rounded px-8 py-6 mb-4" method="post" action="{{ route('login') }}">
				{{ csrf_field() }}
				<div class="flex justify-center mb-6 pt-8">
					<div class="bg-white rounded-full p-2">
						<img class="w-24 h-24" src="{{ asset('logo.png') }}" alt="Whalecore Logo">
					</div>
				</div>

				<div class="text-center mb-4">Enter your login credentails<br>to get access:</div>

				<label class="field mb-4">
					<input class="apperance-none border-b w-full py-2" name="email" type="text" placeholder="Email">
					@if($errors->has('email'))
						<p class="text-red-dark text-xs italic mt-1">{{ $errors->first('email') }}</p>
					@endif
				</label>

				<label class="field mb-4">
					<input class="apperance-none border-b w-full py-2" name="password" type="password" placeholder="******************">
					@if($errors->has('password'))
						<p class="text-red-dark text-xs italic mt-1">{{ $errors->first('password') }}</p>
					@endif
				</label>
				
				<button class="btn-blue py-2 font-bold w-full mb-4 mt-2 uppercase" type="submit">Sign In</button>
				
				<div class="text-center mb-4">
					<span>Don't have an account?</span>
					<a class="text-blue no-underline" href="{{ route('register') }}">Sign up</a>
				</div>
			</form>
			<p class="text-center text-grey-dark text-xs">©{{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
		</div>
	</div>
@stop