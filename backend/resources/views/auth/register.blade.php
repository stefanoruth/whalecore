@extends('app')

@section('body')
    <div class="flex h-screen justify-center items-center">
        <div class="w-full max-w-xs">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="name">Name</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('name') ? 'border-red' : '' }}" id="name" type="text" name="name" value="{{ old('name') }}" autofocus placeholder="Name">
                    @if($errors->has('name'))
                        <p class="text-red text-xs italic">{{ $errors->first('name') }}<p>
                    @endif
                </div>
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="email">Email</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('email') ? 'border-red' : '' }}" id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                    @if($errors->has('email'))
                        <p class="text-red text-xs italic">{{ $errors->first('email') }}<p>
                    @endif
                </div>
                <div class="mb-6">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="password">Password</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('password') ? 'border-red' : '' }}" id="password" type="password" name="password" placeholder="******************">
                    @if($errors->has('password'))
                        <p class="text-red text-xs italic">{{ $errors->first('password') }}<p>
                    @endif
                </div>
                <div class="mb-6">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="password_confirmation">Confirm Password</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('password') ? 'border-red' : '' }}" id="password_confirmation" type="password" name="password_confirmation" placeholder="******************">
                    @if($errors->has('password_confirmation'))
                        <p class="text-red text-xs italic">{{ $errors->first('password_confirmation') }}<p>
                    @endif
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" type="submit">Create</button>
                </div>
            </form>
            <p class="text-center text-grey text-xs">@2017 Whalecore. All rights reserved.</p>
        </div>
    </div>
@endsection