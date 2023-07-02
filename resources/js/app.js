import Alpine from 'alpinejs'
import AlpineFloatingUI from '@awcodes/alpine-floating-ui'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'
import Clipboard from "@ryangjchandler/alpine-clipboard";
import ApexCharts from 'apexcharts'

Alpine.plugin(AlpineFloatingUI)
Alpine.plugin(NotificationsAlpinePlugin)
Alpine.plugin(Clipboard)

window.Alpine = Alpine

Alpine.start()
