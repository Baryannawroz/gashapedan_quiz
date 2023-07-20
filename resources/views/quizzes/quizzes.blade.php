<x-app-layout>
    @if (!count($quiz))
    <div class="flex items-center justify-center h-screen lg:h-auto lg:justify-center mt-7">
        <div class="bg-red-400 text-white p-4 rounded-lg shadow-lg lg:w-auto">
            <p class="text-center lg:text-left">
                هیچ تاقیکردنەوەیەک بەردەست نییە لە ئێستادا
            </p>
        </div>
    </div>
    @else
    @foreach ($quiz as $item)
    <a class="relative flex items-start justify-between rounded-xl border border-gray-100 p-4 shadow-xl sm:p-6 lg:p-8"
        href="/quiz/{{ $item->id }}/show" @if ($item->remainTime <= 0) onclick="return true;" @else
            onclick="return false;" @endif>
            <div class="pt-4 text-gray-500">
                <h3 class="mt-4 text-lg font-bold text-gray-900 sm:text-xl">
                    {{ $item->title }}
                </h3>
                <p class="mt-2 hidden text-sm sm:block">
                    {{ $item->description }}
                </p>
            </div>
            @if (Auth::user()->type==1)
            <div class="ml-auto">
                @if ($item->attempts_allowed == 0)
                <form method="POST" action="/quiz/{{ $item->id }}/activate">
                    @csrf
                    <button class="inline-block px-4 py-2 text-white bg-red-500 rounded cursor-pointer" type="submit">{{
                        __("messages.deactivate Quiz")}}</button>
                </form>
                @else
                <form method="POST" action="/quiz/{{ $item->id }}/deactivate">
                    @csrf
                    <button class=" inline-block px-4 py-2 text-white bg-green-500 rounded cursor-pointer"
                        type="submit">{{
                        __("messages.activate Quiz")}}</button>
                </form>
                @endif
            </div>
            <div>
                <form method="get" action="/quiz/{{ $item->id }}/edit">
                    @csrf
                    <button class=" inline-block px-4 py-2 text-white bg-blue-500 rounded cursor-pointer ml-3"
                        type="submit">گۆرانکاری</button>
                </form>
            </div>
            @endif
            <div class="countdown" data-remain-time="{{ $item->remainTime }}"></div>
    </a>
    @endforeach
    @endif
</x-app-layout>

<script>
    var countdownElements = document.querySelectorAll('.countdown');

    countdownElements.forEach(function (countdownElement) {
        var remainTime = parseInt(countdownElement.getAttribute('data-remain-time'));

        function updateCountdown() {
            var days = Math.floor(remainTime / (24 * 60 * 60));
            var hours = Math.floor((remainTime % (24 * 60 * 60)) / (60 * 60));
            var minutes = Math.floor((remainTime % (60 * 60)) / 60);
            var seconds = remainTime % 60;

            var countdownText = '';
            if (days > 0) {
                countdownText += days + ' day ';
            }
            if (hours > 0) {
                countdownText += hours + ' hour ';
            }
            if (minutes > 0) {
                countdownText += minutes + ' minute ';
            }
            countdownText += seconds + ' second';

            countdownElement.textContent = countdownText;

            remainTime--;

            if (remainTime <= 0) {
                clearInterval(countdownInterval);
                countdownElement.textContent = 'Quiz has started!';
                var anchorElement = countdownElement.parentNode;
                anchorElement.onclick = function() { return true; };
            }
        }

        updateCountdown();
        var countdownInterval = setInterval(updateCountdown, 1000);
    });
</script>
