
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
            <button class="text-green-400" type="submit">{{ __("messages.activate Quiz")}}</button>
        </form>
        @else
        <form method="POST" action="/quiz/{{ $item->id }}/deactivate">
            @csrf
            <button class=" text-red-500" type="submit">{{ __("messages.deactivate Quiz")}}</button>
        </form>
        @endif
    </div>
    @endif
</a>
@endforeach
   
</x-app-layout>