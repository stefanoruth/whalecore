@extends('app')
@section('body')
	<div class="flex justify-center items-center h-screen bg-blue-lightest">
		<div class="w-full max-w-xs">
			<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ route('login') }}">
				{{ csrf_field() }}
				<label class="field">
					<div class="label">Email</div>
					<input class="input {{ $errors->has('email') ? 'border-red' : '' }}" name="email" type="text" placeholder="Email">
					@if($errors->has('email'))
						<p class="text-red text-xs italic mt-1">{{ $errors->first('email') }}</p>
					@endif
				</label>

				<label class="field">
					<div class="label">Password</div>
					<input class="input {{ $errors->has('password') ? 'border-red' : '' }}" name="password" type="password" placeholder="******************">
					@if($errors->has('password'))
						<p class="text-red text-xs italic mt-1">{{ $errors->first('password') }}</p>
					@endif
				</label>

				<div class="flex items-center justify-between">
					<button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" type="submit">Sign In</button>
					<a class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker" href="{{ route('register') }}">Register</a>
				</div>
			</form>
			<p class="text-center text-grey text-xs">©{{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
		</div>
	</div>
@stop