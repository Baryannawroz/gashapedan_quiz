<x-app-layout>
    <form action="/quiz/update" method="POST">
        @csrf
        <div class="mx-3 md:flex mb-6">
            <div class="md:w-full px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="title">
                    Title
                </label>
                <input value="{{ $quiz->title }}"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('title') border-red-500 @enderror"
                    id="title" name="title" type="text" placeholder="Enter Title" ">
                @error('title')
                <p class=" text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mx-3 md:flex mb-6">
            <div class="md:w-full px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="description">
                    Description
                </label>
                <textarea
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('description') border-red-500 @enderror"
                    id="description" name="description"
                    placeholder="Enter Description"> {{ $quiz->description }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mx-3 md:flex mb-6">
            <div class="md:w-full px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="start_time">
                    Start Time
                </label>
                <input value="{{ $quiz->starts_at }}"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('start_time') border-red-500 @enderror"
                    id="start_time" name="start_time" type="datetime-local" value="{{ old('start_time') }}">
                @error('start_time')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mx-3 md:flex mb-6">
            <div class="md:w-full px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="end_time">
                    End Time
                </label>
                <input value="{{ $quiz->ends_at }}"
                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4  leading-tight focus:outline-none focus:bg-white @error('end_time') border-red-500 @enderror"
                    id="end_time" name="end_time" type="datetime-local" value="{{ old('end_time') }}">
                @error('end_time')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <input type="number" hidden value="{{ $quiz->id }}" name='id'>
        <div class="grid justify-center">
            <input
                class="bg-blue-500 text-white font-bold uppercase rounded-full px-10 py-2 relative z-10 hover:translate-y-2 hover:shadow-md hover:bg-blue-600 transition-all duration-300"
                type="submit">
        </div>
    </form>

</x-app-layout>
