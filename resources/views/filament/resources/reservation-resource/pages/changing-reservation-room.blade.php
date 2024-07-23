<x-filament::page>


    {{-- https://apexcharts.com/javascript-chart-demos/timeline-charts/advanced/ --}}
    <div id="chart"></div>

    <div>
        <div><strong>{{ __('reservation.check_in')  }}:</strong> {{ $reservation->check_in }}</div>
        <div><strong>{{ __('reservation.check_out')  }}:</strong> {{ $reservation->check_out }}</div>
    </div>

<form class="mt-10" wire:submit.prevent="submit">
    {{ $this->form }}
    <br/>
    <button type="submit" class="filament-button w-full filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
        {{ __('room.add_room') }}
    </button>
</form>

<div>
    {{ $this->table }}
</div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/pl.min.js" integrity="sha512-rMUyrnrWOTDpjldY8ugJJDlqcP67pvH8lrVYr3xU4xksJRZ1w30p/PaZCbBMWdoRMKf5zfwg1QeFrSRgDuXU9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        moment.locale('pl');
        var options = {
          series: [
          {
            data: [
              @foreach ($reservationRoomsAll as $reservationRoom)
              {
                x: '{{ $reservationRoom->number_place }}',
                y: [
                  new Date('{{ $reservationRoom->check_in }}').getTime(),
                  new Date('{{ $reservationRoom->check_out }}').getTime()
                ],
                check_in: '{{ $reservationRoom->check_in }}',
                check_out: '{{ $reservationRoom->check_out }}',
                name_reservation_person: '{{ $reservationRoom->name_reservation_person }}',
                phone: '{{ $reservationRoom->phone }}',
                id: '{{ $reservationRoom->reservation_id }}',
              },
              @endforeach
            ]
          }
        ],
          chart: {
          height: 350,
          type: 'rangeBar'
        },
        tooltip: {
            custom: function({series, seriesIndex, dataPointIndex, w}) {
            var data = w.globals.initialSeries[seriesIndex].data[dataPointIndex];

            return '<div style="padding:10px"><ul>' +
            '<li><b>' + data.name_reservation_person + '</b> - #' + data.id + '</li>' +
            '<li><b>{{ __('reservation.check_in') }}</b>: ' + data.check_in + '</li>' +
            '<li><b>{{ __('reservation.check_in') }}</b>: ' + data.check_in + '</li>' +
            '<li>' + data.phone + '</li>' +
            '</ul></div>';
            }
        },
        plotOptions: {
          bar: {
            horizontal: true
          }
        },
        xaxis: {
            type: 'datetime',
            labels: {
                formatter: function (value, timestamp) {
                    return moment(value).format("D-MM LT");
                }
            }
        },
        theme: {
          palette: 'palette2'
        },
        events: {
            click: function(event, chartContext, config) {
                console.log(chartContext);
            }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>


</x-filament::page>
