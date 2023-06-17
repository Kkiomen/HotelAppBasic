<x-filament::page>

    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <div class="text-end">
            <button wire:click="getTask" type="button"
                    class="mt-3 filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
                    style="margin-top: 20px"
            >
                Pobierz zadanie
            </button>
            <button type="submit"
                    class="mt-3 filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
                    style="margin-top: 20px"
            >
                Wyślij zadanie
            </button>
        </div>
    </form>

    <div class="bg-white" style="padding: 2rem">
        {{--        <div><strong>Zadanie: </strong> {{ $task }}</div>--}}
        {{--        <div><strong>Odpowiedź: </strong> {{ $answer }}</div>--}}
        {{--        <div style="margin-top: 20px; background-color: #181818; color: #eee; padding: 2rem">--}}
        <div style="background-color: #181818; color: #eee; padding: 2rem">
            <div>
                <div style="background-color: black; padding: 2rem; text-align: center"><img
                        src="https://uploads-ssl.webflow.com/640ee192626d6cd78731bddf/6411e7f0bca8946442e9e5e6_ai-devs-logo.png"/>
                </div>
            </div>
            <div style="margin-top: 10px; display: flex; justify-content: space-between">
                <div>Task TOKEN:</div>
                <div style="display: flex; justify-content: space-between">
                    @foreach($responseToken as $key => $value)
                        <div style="margin-right: 9px">
                            <strong>{{ $key }}</strong> - <span style="color: #16a34a">{{ $value }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="border border-white" style="padding: 1rem; margin-top: 20px">
                <div style="margin-bottom: 10px">
                    <h3>{{ $taskName }}</h3>
                </div>
                <hr/>
                <div style="margin-top: 10px">
                    @foreach($answerResponse as $key => $value)
                        @if(is_array($value))
                            <ul>
                                @foreach($value as $keyValue => $valueValue)
                                    <li><strong>{{ $keyValue }}</strong> - <span style="color: #16a34a">{{ $valueValue }}</span></li>
                                @endforeach
                            </ul>
                        @else
                            <strong>{{ $key }}</strong> - <span style="color: #16a34a">{{ $value }}</span><br/>
                        @endif
                    @endforeach
                </div>
                <div style="margin-top: 10px">
                    {!! json_encode($answerResponse) !!}
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; margin-top: 10px">
                @foreach($responseTotal as $key => $value)
                    <div style="margin-right: 9px">
                        <strong>{{ $key }}</strong> - <span style="color: #16a34a">{{ $value }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


</x-filament::page>
