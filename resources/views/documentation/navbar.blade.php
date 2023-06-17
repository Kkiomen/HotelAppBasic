<nav class="sticky top-[4.5rem] w-64 pr-8 text-base lg:text-sm xl:w-72 xl:pr-16">
    <ul role="list" class="-ml-0.5 h-[calc(100vh-4.5rem)] overflow-y-auto py-7 pl-0.5 space-y-8">
        <li>
            <h3 class="font-semibold tracking-tight text-slate-900">
                Pierwsze kroki
            </h3>

            <ul role="list" class="pl-3 mt-3 space-y-2">
                <li>
                    <a href="{{ route('documentation') }}" class="text-slate-600 hover:text-slate-800">
                        Jak działa Aisello?
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <h3 class="font-semibold tracking-tight text-slate-900">
                Generator opisów produktów
            </h3>

            <ul role="list" class="pl-3 mt-3 space-y-2">
                <li>
                    <a href="{{ route('documentationSave') }}" class="text-slate-600 hover:text-slate-800">
                        Przesyłanie produktów do Aisello
                    </a>
                </li>

                <li>
                    <a href="{{ route('documentationSend') }}" class="text-slate-600 hover:text-slate-800">
                        Przesyłanie opisów do własnej aplikacji
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</nav>
