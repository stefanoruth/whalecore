@extends('partials.bone')

@section('body')
    <div class="flex h-screen justify-center items-center">
        <div class="w-full max-w-xs">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">Email</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email" type="text" name="email" placeholder="Email">
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">Password</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="password" type="password" name="password" placeholder="******************">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" type="submit">Sign In</button>
                <a class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker" href="#">Forgot Password?</a>
            </div>
        </form>
        <p class="text-center text-grey text-xs">@2017 Whalecore. All rights reserved.</p>
    </div>
    </div>
@stop