<x-app-layout>

  @if (Auth()->user()->type==1)
  
  <div class="flex flex-col items-center">
  <a href="/create/quiz"
  class="bg-blue-500 text-white font-bold uppercase rounded-full px-10 py-2 my-4 relative z-10 hover:translate-y-2 hover:shadow-md hover:bg-blue-600 transition-all duration-300">
  @lang('messages.create quiz')
  </a>
  
  <a href="/create/question"
  class="bg-blue-500 text-white font-bold uppercase rounded-full px-10 py-2 my-4 relative z-10 hover:translate-y-2 hover:shadow-md hover:bg-blue-600 transition-all duration-300">
  @lang('messages.create question')
</a>
<a href="result"
class="bg-yellow-400 text-white font-bold uppercase rounded-full px-10 py-2 my-4 relative z-10 hover:translate-y-2 hover:shadow-md hover:bg-yellow-500 transition-all duration-300">
@lang('messages.result')
</a>

<a href="quizzes/check"
  class="bg-yellow-400 text-white font-bold uppercase rounded-full px-10 py-2 my-4 relative z-10 hover:translate-y-2 hover:shadow-md hover:bg-yellow-500 transition-all duration-300">
  @lang('messages.quiz information')
</a>
  </div>

  @else
  <div class="flex flex-col items-center">
    <a href="quizzes"
      class="bg-yellow-400 text-white font-bold uppercase rounded-full px-10 py-2 my-4 relative z-10 hover:translate-y-2 hover:shadow-md hover:bg-yellow-500 transition-all duration-300">
      @lang('messages.quizzes')
    </a>

    <a href="result/Self"
      class="bg-blue-500 text-white font-bold uppercase rounded-full px-10 py-2 my-4 relative z-10 hover:translate-y-2 hover:shadow-md hover:bg-blue-600 transition-all duration-300">
      @lang('messages.self result')
    </a>
  </div>
  @endif

</x-app-layout>