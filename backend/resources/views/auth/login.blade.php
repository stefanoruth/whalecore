@extends('app')

@section('body')
    <div class="flex h-screen justify-center items-center">
        <div class="w-full max-w-xs">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="email">Email</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('email') ? 'border-red' : '' }}" id="email" type="text" name="email" placeholder="Email">
                    @if($errors->has('email'))
                        <p class="text-red text-xs italic">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="mb-6">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="password">Password</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('password') ? 'border-red' : '' }}" id="password" type="password" name="password" placeholder="******************">
                    @if($errors->has('password'))
                        <p class="text-red text-xs italic">{{ $errors->first('password') }}</p>
                    @endif
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" type="submit">Sign In</button>
                </div>
            </form>
            <p class="text-center text-grey text-xs">@2017 Whalecore. All rights reserved.</p>
            <p class="text-center text-grey text-xs mt-2">Don't have an account, create one <a class="text-blue hover:text-blue-darker" href="{{ route('register') }}">here</a></p>
        </div>
    </div>
@stop