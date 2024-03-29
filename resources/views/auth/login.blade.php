@extends('master')

@section('body')
	<div class="flex justify-center items-center h-screen bg-gradient">
		<div class="w-full max-w-xs">
			<form class="bg-white rounded-lg shadow-lg px-8 py-6" method="post" action="{{ route('login') }}">
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
						<p class="text-red text-xs italic mt-1">{{ $errors->first('email') }}</p>
					@endif
				</label>

				<label class="field mb-4">
					<input class="apperance-none border-b w-full py-2" name="password" type="password" placeholder="******************">
					@if($errors->has('password'))
						<p class="text-red text-xs italic mt-1">{{ $errors->first('password') }}</p>
					@endif
				</label>
				
				<button class="btn-primary" type="submit">Sign In</button>
			</form>
		</div>
	</div>
@stop