<x-filament::page>

    @if($tokens->count() == 0)

        <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 mt-6">
            <div class="p-6 pb-0">
                {{ Lang::get('basic.empty_token') }}
            </div>
        </div>

    @endif


    @foreach($tokens as $token)
        <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 mt-6">
            <div class="flex  justify-between">
                <div class="p-3">
                    <h1>Access Token</h1>
                </div>
                <div class="p-3">
                    <x-antdesign-delete />
                </div>
            </div>
            <div class="px-6">
                <div class="relative w-full">
                    <input type="text"  class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-100 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                           placeholder="Token" value="{{ $token->token }}" readonly required>
                </div>
            </div>
            <div class="border-t-2 border-neutral-100 px-6 text-sm text-gray-500 py-2 dark:border-neutral-600 dark:text-neutral-50">
                Wygenerowano dnia: {{ $token->created_at }} - <span wire:click="deleteNotification({{ $token->id }})" class="text-red-400 font-bold cursor-pointer">Usuń</span>
            </div>
        </div>
    @endforeach

</x-filament::page>
