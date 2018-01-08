@extends('master')

@section('body')
    <div id="sales" class="bg-hero font-sans min-h-screen">
        <div class="h-3 bg-blue"></div>
        <div class="p-8">
            <div class="text-center mt-20 mx-auto max-w-md">
                <div class="mb-8">
                    <img class="h-24 w-24" src="{{ asset('logo.png') }}" alt="Whalecore Logo">
                </div>
                <div class="text-3xl py-6">Whoops! This is slightly embarrassing</div>
                <div class="mb-6 text-base text-grey-dark">We're just tidying up the last pieces and getting ready to help you all being amazing sailors! Sign up for our newsletter to receive the latest news</div>
                <label class="mb-8 block">
                    <div class="mb-2 text-grey-dark">We will never send you spam!</div>   
                    <div class="mb-6 text-base text-grey-dark">
                        <input class="w-full p-4 border-b-4 outline-none bg-transparent" v-model="mail" type="text" placeholder="Enter your email" @keyup.enter="subscribe">                            
                    </div>                 
                    <button class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-8 border border-blue hover:border-transparent rounded-full" @click="subscribe">Signup</button>
                    <div class="mt-2 text-blue" v-if="successMsg != null">@{{ successMsg }}</div>
                    <div class="mt-2 text-red-dark" v-if="errorMsg != null">@{{ errorMsg }}</div>
                </label>
            </div>
        </div>
    </div>

    <script src="{{ mix('sales.js') }}"></script>
@stop