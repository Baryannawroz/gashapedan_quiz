<x-app-layout>


    @foreach ($quiz as $item)
    <a class="relative flex items-start justify-between rounded-xl border border-gray-100 p-4 shadow-xl sm:p-6 lg:p-8"
        href="/quiz/{{ $item->id }}/show">
        <div class="pt-4 text-gray-500">

            <h3 class="mt-4 text-lg font-bold text-gray-900 sm:text-xl">
                {{ $item->title }}
            </h3>

            <p class="mt-2 hidden text-sm sm:block">
                {{ $item->description }}
            </p>
        </div>

        @if ((Auth::user()->type)==1)


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
                <button class=" inline-block px-4 py-2 text-white bg-green-500 rounded cursor-pointer" type="submit">{{
                    __("messages.activate Quiz")}}</button>
            </form>
            @endif
        </div>
        @endif
        <br>

        <div>
            <form method="get" action="/quiz/{{ $item->id }}/edit">
                @csrf
                <button class=" inline-block px-4 py-2 text-white bg-blue-500 rounded cursor-pointer ml-3"
                type="submit">گۆرانکاری</button>
            </form>
        </div>
        </a>
    @endforeach

</x-app-layout>
