@extends('layouts.base')

@section('body')
    <div class="flex justify-center items-center text-center h-screen">
        <div class="text-center">
            <img src="{{ asset('assets/img/logo-black.png') }}" class="w-80 mx-auto"/>
            <div>
                Automatyczne generowanie opisów
            </div>
            <div class="mt-9 flex gap-3">
                <a href="{{ asset('admin/login') }}">
                    <div class="bg-amber-600 text-white shadow p-4 rounded text-center">
                        Przejdź do panelu
                    </div>
                </a>
                <a href="{{ route('documentation') }}">
                    <div class="bg-gray-800 text-white shadow p-4 rounded text-center">
                        Dokumentacja
                    </div>
                </a>
            </div>
            <div class="bg-white py-10">
                <div class="mx-auto max-w-7xl px-6 lg:px-8 flex items-center">
                    <h2 class="text-center text-md font-semibold leading-8 text-gray-900">Powered by:</h2>
                    <img class="col-span-2 max-h-12 w-20 mx-auto object-contain lg:col-span-1" src="https://sente.pl/wp-content/themes/sente/assets/images/logo_black_5_@svg.svg">
                </div>
            </div>
        </div>

    </div>
@endsection
