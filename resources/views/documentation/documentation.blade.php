@extends('layouts.base')

@section('body')
    <header class="sticky top-0 z-50 flex items-center justify-between px-3 py-2 border-b shadow-lg bg-white/90 backdrop-blur-sm border-slate-400/40">
        <div class="flex items-center flex-grow basis-0">
            <a href="" class="text-lg font-semibold tracking-tight text-slate-900">
                Dokumentacja Aisello
            </a>
        </div>

{{--        <form action="https://duckduckgo.com/" class="md:w-80 lg:w-96">--}}
{{--      <span class="relative flex items-center group">--}}
{{--        <svg aria-hidden="true" viewBox="0 0 20 20" class="absolute w-4 h-4 ml-3 fill-slate-400 group-hover:fill-slate-500 group-focus:fill-slate-500"><path d="M16.293 17.707a1 1 0 0 0 1.414-1.414l-1.414 1.414ZM9 14a5 5 0 0 1-5-5H2a7 7 0 0 0 7 7v-2ZM4 9a5 5 0 0 1 5-5V2a7 7 0 0 0-7 7h2Zm5-5a5 5 0 0 1 5 5h2a7 7 0 0 0-7-7v2Zm8.707 12.293-3.757-3.757-1.414 1.414 3.757 3.757 1.414-1.414ZM14 9a4.98 4.98 0 0 1-1.464 3.536l1.414 1.414A6.98 6.98 0 0 0 16 9h-2Zm-1.464 3.536A4.98 4.98 0 0 1 9 14v2a6.98 6.98 0 0 0 4.95-2.05l-1.414-1.414Z"></path></svg>--}}
{{--        <input type="text" name="q" placeholder="Search docs…" class="w-full py-2 pl-10 pr-2 border rounded bg-slate-100 placeholder-slate-400 text-slate-800 border-slate-100 outline outline-offset-2 outline-2 outline-transparent hover:border-slate-200 focus:border-slate-200 focus:outline-slate-600" />--}}
{{--      </span>--}}
{{--            <input type="hidden" name="sites" value="spinalcms.com">--}}
{{--            <input type="submit" value="Search" class="sr-only" />--}}
{{--        </form>--}}

        <div class="items-center justify-end flex-grow hidden basis-0 md:flex">
            <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-semibold rounded bg-slate-900 text-slate-50 transition ease-in-out delay-75 hover:scale-105 duration-200">
                Strona Główna
            </a>
        </div>
    </header>

    <main class="relative flex justify-center mx-auto max-w-8xl sm:px-2 lg:px-8 xl:px-12">
        <label for="navigation" class="fixed bottom-0 left-0 z-50 flex items-center justify-center w-12 h-12 mb-4 ml-4 bg-white border rounded-full shadow-lg cursor-pointer text-slate-600 border-slate-300 lg:hidden transition duration-200 ease-in-out active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
            </svg>
        </label>

        <input type="checkbox" name="navigation" id="navigation" class="hidden peer" />
        <div class="fixed top-[3.5rem] h-screen shadow-xl px-4 left-0 hidden peer-checked:block lg:relative lg:top-0 lg:h-auto lg:px-0 lg:block lg:flex-none lg:shadow-none">
            <div class="absolute inset-y-0 right-0 w-full lg:w-[50vw] bg-white lg:bg-slate-50"></div>
            @include('documentation.navbar')
        </div>

        <div class="flex-auto max-w-2xl min-w-0 px-4 py-10 lg:max-w-none lg:pr-0 lg:pl-8 xl:px-16">
            <article class="">
                <header class="">
                    <p class="text-base font-medium text-slate-500">
                        Pierwsze kroki
                    </p>

                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                        Jak działa Aisello?
                    </h1>
                </header>

{{--                <p class="mt-2 text-xl text-slate-600">--}}
{{--                    Need to get started quickly with Spinal? You will learn all the basics in just minutes.--}}
{{--                </p>--}}

                <div class="mt-8 prose prose-slate max-w-none prose-headings:font-semibold prose-headings:tracking-tight prose-lead:text-slate-500 prose-a:font-semibold prose-a:underline prose-pre:bg-slate-900">

                    <p class="mb-3 text-gray-500 dark:text-gray-400">
                        Aisello jest dynamicznym narzędziem, które łączy zaawansowane technologie sztucznej inteligencji i uczenia maszynowego z chatbotem GPT, aby usprawnić i zautomatyzować proces tworzenia opisów produktów.
                    </p>

                    <p class="mb-3 text-gray-500 dark:text-gray-400">
                        Pierwszym krokiem w korzystaniu z Aisello jest integracja za pomocą API. Ta procedura umożliwia naładowanie bazy danych produktów bezpośrednio do systemu Aisello. Dzięki temu, możliwe jest automatyczne generowanie opisów na podstawie dostarczonych informacji o produkcie. Algorytmy Aisello analizują te dane, identyfikują kluczowe cechy i atrakcje każdego produktu, a następnie tworzą precyzyjne, zwięzłe i przekonujące opisy.
                    </p>

                    <p class="mb-3 text-gray-500 dark:text-gray-400">
                        Po wygenerowaniu opisów, Aisello oferuje użytkownikom możliwość edycji informacji za pomocą intuicyjnego panelu użytkownika. <br/>Ten interfejs użytkownika jest łatwy do nawigacji i zaprojektowany z myślą o maksymalnym komforcie użytkownika. Użytkownicy mogą przeglądać wygenerowane opisy, wprowadzać zmiany, dodawać własne unikalne informacje i dostosowywać opisy do swoich specyficznych potrzeb.
                    </p>

                    <p class="mb-3 text-gray-500 dark:text-gray-400">
                        Aisello wyróżnia się na rynku także dzięki funkcji przesyłania danych za pomocą webhook. To znaczy, że po wygenerowaniu i ewentualnej edycji opisu, Aisello automatycznie przesyła te informacje bezpośrednio na stronę klienta. Ten proces eliminuje potrzebę ręcznego przenoszenia informacji, co jest szczególnie przydatne dla dużych sklepów internetowych z setkami czy nawet tysiącami produktów.
                    </p>

                    <p class="mb-3 text-gray-500 dark:text-gray-400">
                        Przez zautomatyzowanie procesu tworzenia opisów, Aisello umożliwia firmom oszczędzanie znacznej ilości czasu i zasobów, które zazwyczaj są wykorzystywane na zatrudnianie i zarządzanie zespołami copywriterów. W praktyce, funkcje oferowane przez Aisello mogą zastąpić prace kilku etatów copywriterów, co przekłada się na bezpośrednie oszczędności finansowe.
                    </p>


                    <p class="mb-3 text-gray-500 dark:text-gray-400">
                        Aisello jest potężnym narzędziem, które przyspiesza i upraszcza proces tworzenia opisów produktów. Dzięki zastosowaniu technologii sztucznej inteligencji, automatyzacji i intuicyjnej interfejsu użytkownika, Aisello pozwala przedsiębiorstwom skupić się na tym, co najważniejsze - sprzedaży swoich produktów.
                    </p>


                </div>
            </article>

            <dl class="flex pt-6 mt-6 border-t border-slate-200">
{{--                <div class="mr-auto text-left">--}}
{{--                    <dt class="text-sm font-normal tracking-tight text-slate-600">--}}
{{--                        Previous--}}
{{--                    </dt>--}}

{{--                    <dd class="mt-1">--}}
{{--                        <a href="#" class="text-base font-semibold text-slate-900 hover:underline">--}}
{{--                            Quick start guide--}}
{{--                        </a>--}}
{{--                    </dd>--}}
{{--                </div>--}}

                <div class="ml-auto text-right">
                    <dt class="text-sm font-normal tracking-tight text-slate-600">
                        Następny
                    </dt>

                    <dd class="mt-1">
                        <a href="{{ route('documentationSave') }}" class="text-base font-semibold text-slate-900 hover:underline">
                            Przesyłanie produktów do Aisello
                        </a>
                    </dd>
                </div>
            </dl>
        </div>
    </main>
@endsection
