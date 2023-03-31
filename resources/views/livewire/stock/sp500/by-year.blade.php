<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <h1 class="text-4xl">USA 500 <span class="text-gray-400 text-sm">ES</span></h1>
        <p class="ml-1 text-gray-400 text-sm">USA 500 Futures CFD, based on the S&P 500 E-mini futures.</p>
        <div class="mt-4 space-y-2">
            <p class="title-price flex flex-row">
                <span id="rate" class="text-blue-800 text-4xl animate-pulse" >loading...</span>
                <span id="rate_change_class" class="ml-4 flex flex-row items-end">
                    <span id="rate_change"  class="font-bold text-md"></span>
                    <span>
                        <svg id="rate_change_icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75" />
                        </svg>
                    </span>
                </span>
            </p>
            <p>
                <span>
                    <span>High:</span>
                    <strong id="rate_high">{{$rate_high}}</strong>
                </span>
                <span>
                    <span>Low:</span>
                    <strong id="rate_low">{{$rate_low}}</strong>
                </span>
            </p>
        </div>
        <div class="w-36 mt-8">
            <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Data after:</label>
            <select wire:model="selectedyear" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-orange-600 sm:text-sm sm:leading-6">
                <option value="null" disabled>{{ __('Please select') }}</option>
                @foreach($years as $year)
                    <option>{{$year}}</option>
                @endforeach
            </select>
        </div>
        <div class="p-6 text-gray-900">
            <div>
                <h3 class="text-base font-semibold leading-6 text-gray-900">Total High/Low</h3>
                <dl class="mt-5 grid grid-cols-3 gap-5">
                    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500">Total High</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{round(100/$total*$total_high,0)}} %</dd>
                    </div>

                    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500">Total Low</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{round(100/$total*$total_low,0)}} %</dd>
                    </div>

                    <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500">Total equal</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{round(100/$total*$total_middle,0)}} %</dd>
                    </div>
                </dl>
            </div>
            <div class="mt-4">
                <div>
                    <div class="mb-1 text-lg font-medium dark:text-white">{{round(100/$total*$less15)}}%<span class="text-gray-400 text-sm"> less 15</span></div>
                    <div class="w-full h-4 mb-4 bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="h-4 bg-blue-600 rounded-full dark:bg-blue-500" style="width: {{round(100/$total*$less15)}}%"></div>
                    </div>
                </div>
                <div>
                    <div class="mb-1 text-lg font-medium dark:text-white">{{round(100/$total*$less30)}}% <span class="text-gray-400 text-sm"> less 30</span></div>
                    <div class="w-full h-4 mb-4 bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="h-4 bg-blue-600 rounded-full dark:bg-blue-500" style="width: {{round(100/$total*$less30)}}%"></div>
                    </div>
                </div>
                <div>
                    <div class="mb-1 text-lg font-medium dark:text-white">{{round(100/$total*$less50)}}%<span class="text-gray-400 text-sm"> less 50</span></div>
                    <div class="w-full h-4 mb-4 bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="h-4 bg-blue-600 rounded-full dark:bg-blue-500" style="width: {{round(100/$total*$less50)}}%"></div>
                    </div>
                </div>
                <div>
                    <div class="mb-1 text-lg font-medium dark:text-white">{{round(100/$total*$less100)}}%<span class="text-gray-400 text-sm"> less 100</span></div>
                    <div class="w-full h-4 mb-4 bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="h-4 bg-blue-600 rounded-full dark:bg-blue-500" style="width: {{round(100/$total*$less100)}}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

        <script>
            $(function(){
                function ajaxCallDownload(){
                    $.ajax({
                        url: "{{url('/RequestGetUSA500Array')}}",
                        success: function( response ) {
                            array = response;
                            document.getElementById('rate').classList.remove('animate-pulse');

                            document.getElementById('rate').innerHTML = array['SellPrice'];
                            document.getElementById('rate_change').innerHTML = array['ChangePercentText'];
                            if(array['ChangePercent'] >= 0 ){
                                document.getElementById('rate_change_class').classList.add('text-green-600');
                            }else{
                                document.getElementById('rate_change_class').classList.add('text-red-600');
                                document.getElementById('rate_change_icon').classList.add('rotate-180');
                            }
                            document.getElementById('rate_high').innerHTML = array['HighPrice'];
                            document.getElementById('rate_low').innerHTML = array['LowPrice'];
                        }
                    });
                }
                setInterval(ajaxCallDownload, 10000);
            });
        </script>

</div>


