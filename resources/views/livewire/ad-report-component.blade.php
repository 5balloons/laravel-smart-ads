<div>
<div>
    <!-- Cards -->
    <div>
        <div class="mb-3 ml-1 dark:text-purple-800 font-semibold text-lg">Clicks Summary</div>
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4 rounded">
            <div class="p-5 bg-white dark:bg-gray-600 dark:text-gray-100 rounded border border-gray-600">
                <div class="text-sm">Today so far</div>
                <div class="text-lg mt-2 text-purple-700 font-semibold dark:text-white">{{$totalClicksToday}}</div>
            </div> 
            <div class="p-5 bg-white dark:bg-gray-600 dark:text-gray-100 rounded border border-gray-600">
                <div class="text-sm">Yesterday</div>
                <div class="text-lg mt-2 text-purple-700 font-semibold dark:text-white">{{$totalClicksYesterday}}</div>
            </div> 
            <div class="p-5 bg-white dark:bg-gray-600 dark:text-gray-100 rounded border border-gray-600">
                <div class="text-sm">Last 7 days</div>
                <div class="text-lg mt-2 text-purple-700 font-semibold dark:text-white">{{$totalClicks7Days}}</div>
            </div>
            <div class="p-5 bg-white dark:bg-gray-600 dark:text-gray-100 rounded border border-gray-600">
                <div class="text-sm">This month</div>
                <div class="text-lg mt-2 text-purple-700 font-semibold dark:text-white">{{$totalClicksThisMonth}}</div>
            </div>   
        </div>
    </div>
    <div class="mt-5 bg-gray-100 rounded p-3 border border-gray-200">
        <div class="flex justify-between">
            <div class="mb-3 ml-1 dark:text-purple-800 font-semibold text-lg">Click Report By Date</div>
            <!-- Date range picker -->
            <div class="mr-7 mb-3">
            <div wire:ignore id="reportrange" class="flex items-center space-x-2" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                <span></span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>

            </div>
            </div>
        </div>
        <div style="height: 400px">
            <canvas id="myChart"></canvas>
        </div>
        <div class="mt-7">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-xl font-semibold text-gray-900">Ad Clicks</h1>
                        <p class="mt-2 text-sm text-gray-700">List of Ads with clicks count for the selected period.</p>
                    </div>
                </div>
                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Ad</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Clicks</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($clicksPerAd as $adClick)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{$adClick['name']}}</td>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{$adClick['clicks']}}</td>
                                    </tr>
                                @endforeach
                            </tr>
                            <!-- More people... -->
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
$(function() {

    /** Date picker code start */
    var start = moment().subtract(6, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        @this.set('reportStartDate', start.format('YYYY-MM-DD'));
        @this.set('reportEndDate', end.format('YYYY-MM-DD'));
        @this.calculateClicksReport();
    }

    $('#reportrange').daterangepicker({
        opens: 'left',
        startDate: start,
        endDate: end,
        autoApply: true,
        maxDate: moment(),
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        alwaysShowCalendars: true,
    }, cb);

    cb(start, end);

    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        @this.set('reportStartDate', picker.startDate.format('YYYY-MM-DD'));
        @this.set('reportEndDate', picker.endDate.format('YYYY-MM-DD'));
        @this.calculateClicksReport();
    });
    /** Date picker code ends */

    Livewire.on('renderChart', postId => {
        /** Chart.js code starts */
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
            labels: Object.keys(@this.clicksPerDate),
                datasets: [{
                    label: '# of Clicks',
                    data: Object.values(@this.clicksPerDate),
                    borderColor: 'rgb(79, 70, 229)',
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                maintainAspectRatio: false,
            },
        });
        /** Chart.js code ends */
    });
   
});


</script>
</div>