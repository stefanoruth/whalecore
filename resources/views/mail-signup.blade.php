@extends('master')

@section('body')
    <div id="sales" class="bg-hero font-sans min-h-screen">
        <div class="h-3 bg-blue"></div>
        <div class="p-8">
            <div class="mt-8 mx-auto max-w-lg">
                <div class="flex items-center mb-8">
                    <img class="h-16 w-16 mr-4" src="{{ asset('logo.png') }}" alt="Whalecore Logo">
                    <span class="text-xl">Whalecore</span>
                </div>
                <div class="text-3xl py-6">Lorem ipsum dolor sit amet.</div>
                <div class="mb-6 text-xl text-grey-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti impedit saepe magni maxime, quos voluptatibus accusantium a provident quibusdam vitae? Fugiat laborum fuga sapiente perspiciatis ut necessitatibus suscipit mollitia est!</div>
                <label class="mb-8 block">
                    <div class="mb-2 text-grey-dark">Sign up for the newsletter</div>
                    <div class="flex">
                        <input class="px-3 py-2 text-xl text-grey-darker max-w-xs flex-1 shadow rounded-l-lg leading-normal" v-model="mail" type="text" placeholder="Enter your email" @keyup.enter="subscribe">
                        <button class="text-xl bg-blue appearance-none px-6 py-2 text-white hover:bg-blue-dark shadow rounded-r-lg leading-normal" @click="subscribe">Signup</button>
                    </div>
                    <div class="mt-2 text-blue" v-if="successMsg != null">@{{ successMsg }}</div>
                    <div class="mt-2 text-red-dark" v-if="errorMsg != null">@{{ errorMsg }}</div>
                </label>
            </div>
        </div>
    </div>

    <script src="{{ mix('sales.js') }}"></script>
@stop