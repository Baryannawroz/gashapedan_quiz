<x-app-layout>
    <div class="flex flex-wrap mx-4 mt-4">
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3 px-4 mb-4">
            <div class="border border-gray-300 p-4 rounded-lg">
                <p class="text-center font-bold text-blue-500 mb-2 "> ڕاپۆرتی تاقیکردنەوە بەپێ تاقیکردنەوەکان </p>
                <label for="quiz_id1" class="text-center block mb-2 text-sm font-medium text-gray-900 dark:text-white">ناوی تاقیکردنەوەکە</label>
                    <form action="result_quizname" method="GET">

                        <input id="quiz-id" list="quiz" name="quiz"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <datalist id="quiz" class="">

                            @foreach ($quizzes as $quiz )
                            <option value="{{ $quiz->title }}">
                                @endforeach

                            </datalist>
<div class="flex justify-center">
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-5">
        گەڕان
    </button>
</div>
                        </form>
            </div>
        </div>
        <!-- ...other boxes... -->
    </div>
</x-app-layout>
