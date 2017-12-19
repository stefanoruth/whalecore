@extends('app')
@section('body')
<div class="flex justify-center items-center h-screen bg-blue-lightest">
	<div class="w-full max-w-xs">
		<form class="bg-white shadow rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ route('register') }}">
			{{ csrf_field() }}

			<label class="field">
				<div class="label">Name</div>
				<input type="text" class="input {{ $errors->has('name') ? 'border-red' : '' }}" name="name" autofocus value="{{ old('name') }}">
				@if($errors->has('name'))
					<p class="text-red text-xs italic mt-1">{{ $errors->first('name') }}</p>
				@endif
			</label>

			<label class="field">
				<div class="label">Email</div>
				<input type="text" class="input {{ $errors->has('email') ? 'border-red' : '' }}" name="email" value="{{ old('email') }}">
				@if($errors->has('email'))
					<p class="text-red text-xs italic mt-1">{{ $errors->first('email') }}</p>
				@endif
			</label>

			<label class="field">
				<div class="label">Password</div>
				<input type="password" class="input {{ $errors->has('password') ? 'border-red' : '' }}" name="password">
				@if($errors->has('password'))
					<p class="text-red text-xs italic mt-1">{{ $errors->first('password') }}</p>
				@endif
			</label>

			<label class="field">
				<div class="label">Password Confirmation</div>
				<input type="password" class="input {{ $errors->has('password_confirmation') ? 'border-red' : '' }}" name="password_confirmation">
				@if($errors->has('password_confirmation'))
					<p class="text-red text-xs italic mt-1">{{ $errors->first('password_confirmation') }}</p>
				@endif
			</label>

			<div class="flex items-center justify-between">
				<button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" type="submit">Create</button>
			</div>
		</form>
		<p class="text-center text-grey text-xs">©{{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
	</div>
</div>
@stop