<x-filament::page>
    @if ($description)

        <div class="bg-white rounded">
            <div class="pt-6">

                <!-- Image gallery -->
                <div class="mx-auto mt-6 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8">
                    <div class="aspect-h-5 aspect-w-4 hidden lg:aspect-h-4 lg:aspect-w-3 md:block sm:rounded-lg p-8">
                        <div class="bg-gray-200 w-full h-full sm:h-[6rem] rounded-2xl"></div>
                    </div>
                    <div class="lg:row-span-3 lg:mt-0 px-6 pt-8 mb-8" style="padding-top: 2rem; padding-bottom: 2rem">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $description->product_name }}</h1>
                        <div class="text-3xl bg-gray-200 rounded-2xl tracking-tight text-gray-900 mb-5"
                             style="width: 40%; height: 20px; margin-top: 20px"></div>


                        <div class="mt-10">
                            <fieldset class="mt-4">
                                <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                                    <label
                                        class="group relative flex items-center justify-center rounded-md py-3 px-4 sm:flex-1 sm:py-6 bg-gray-200"></label>
                                    <label
                                        class="group relative flex items-center justify-center rounded-md py-3 px-4 sm:flex-1 sm:py-6 bg-gray-200"></label>
                                    <label
                                        class="group relative flex items-center justify-center rounded-md py-3 px-4 sm:flex-1 sm:py-6 bg-gray-200"></label>
                                    <label
                                        class="group relative flex items-center justify-center rounded-md py-3 px-4 sm:flex-1 sm:py-6 bg-gray-200"></label>
                                    <label
                                        class="group relative flex items-center justify-center rounded-md py-3 px-4 sm:flex-1 sm:py-6 bg-gray-200"></label>
                                    <label
                                        class="group relative flex items-center justify-center rounded-md py-3 px-4 sm:flex-1 sm:py-6 bg-gray-200"></label>
                                    <label
                                        class="group relative flex items-center justify-center rounded-md py-3 px-4 sm:flex-1 sm:py-6 bg-gray-200"></label>
                                    <label
                                        class="group relative flex items-center justify-center rounded-md py-3 px-4 sm:flex-1 sm:py-6 bg-gray-200"></label>
                                </div>
                            </fieldset>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white px-6 py-6 rounded-xl">
            <div wire:loading class="mt-3 mb-4 w-full" style="margin-bottom: 20px">
                <div class="flex justify-center items-center h-12" role="status">
                    <span class="visually-hidden text-amber-600"><x-uiw-loading
                            class="spin-animation h-8 w-8 animate-spin"/></span>
                </div>
            </div>

            <div class="example-view">
                {!! $description->result !!}
            </div>

        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-1 lg:grid-cols-2">
            <button wire:click="generateNewDescription">Wygeneruj na nowo opis</button>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-1 lg:grid-cols-2">
                <button
                    class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
                    wire:click="acceptDescription">Akceptuj opis
                </button>
                <button
                    class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 hover:underline focus:ring-offset-primary-700 filament-page-button-action"
                    style="background-color: #9333ea"
                    wire:click="acceptDescriptionAndSend">Prześlij do systemu
                </button>
            </div>
        </div>

    @else
        <p>Brak opisów do akceptacji.</p>
    @endif


    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('textarea[name="description"]').forEach(function (el) {
                el.style.height = `${el.scrollHeight}px`;
                el.style.overflowY = 'hidden';
            });
        });
    </script>
</x-filament::page>
