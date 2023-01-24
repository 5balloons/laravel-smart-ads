<div>
    <!-- Cards -->
    <div>
        <div class="mb-3 ml-1 dark:text-gray-300">Clicks</div>
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
    <!-- Date range picker -->
     <div class="flex justify-end mr-7 mb-3">
        <input type="text" id="reportrange" name="dates" class="rounded w-full md:w-1/4 border border-gray-600"/>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        opens: 'left',
        startDate: start,
        endDate: end,
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
    });


});


</script>