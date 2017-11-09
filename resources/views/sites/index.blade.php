@extends('app')
@section('bodyClass', 'bg-blue')
@section('hideMenu', true)

@section('body')
    <div class="flex h-screen justify-center items-center" id="dashboard">
        @foreach($sites as $site)
            <div class="w-48 h-48 cursor-pointer rounded overflow-hidden bg-white shadow-lg m-4" @click="loginToSite({{ $site->id }})">
                <img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $site->title }}</div>
                </div>
            </div>
        @endforeach
        <div class="w-48 h-48 cursor-pointer rounded overflow-hidden bg-white shadow-lg m-4" @click="showNewSiteModal = true">
            <div class="flex justify-center items-center h-full">
                <div class="font-bold text-xl mb-2">New site</div>
            </div>
        </div>
        <new-site-modal :show="showNewSiteModal" @close="showNewSiteModal = false"></new-site-modal>
    </div>
@stop