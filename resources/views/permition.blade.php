<x-app-layout>
<table class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th scope="col" class="px-6 py-3 text-lg font-bold text-left text-gray-500 uppercase tracking-wider">Name
            </th>
            <th scope="col" class="px-6 py-3 text-lg font-bold text-left text-gray-500 uppercase tracking-wider">Email
            </th>
            <th scope="col" class="px-6 py-3 text-lg font-bold text-left text-gray-500 uppercase tracking-wider">Action
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($users as $user)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <form method="POST" action="{{ route('activate-user', $user->id) }}">
                    @csrf
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Activate
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-app-layout>