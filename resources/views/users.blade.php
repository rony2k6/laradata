<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    </head>
    <body class="bg-gray-100 ">

        <div class="container relative flex justify-center mx-auto">
            <div class="flex flex-col">
                <div class="w-full">
                    <div class="flex justify-left pt-8 sm:justify-start sm:pt-0 my-10">
                        <h1 class="text-3xl font-bold">Top Secret CIA database</h1>
                    </div>
                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="">
                                    <div class="overflow-hidden pb-2">

                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="first_name" class="block text-sm font-medium text-gray-700">Birth Year</label>
                                                    <input type="number" name="year" id="birthYear" min="1900" max="2099" value="{{ Request::get('year') }}" class="border-2 border-primary bg-red transition h-10 px-2 pr-1 rounded-md focus:outline-none w-full text-black text-lg">
                                                </div>
                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Birth Month</label>
                                                    <input type="number" name="month" id="last_name" min="01" max="12" value="{{ Request::get('month') }}" class="border-2 border-primary bg-red transition h-10 px-2 pr-1 rounded-md focus:outline-none w-full text-black text-lg">
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="last_name" class="block text-sm font-medium text-gray-700">&nbsp;</label>
                                                    <button type="submit" class="inline-flex justify-center py-2 px-8 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                        Filter
                                                    </button>
                                                </div>
                                            </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col text-left">
                        <div class="my-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white py-4">

                                @if ( count($users) > 0 )
                                    {{ $users->links() }}

                                    <table class="min-w-full divide-y divide-gray-200 my-6 border-t border-b">
                                        <thead class="bg-white">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Email
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    ID
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Full Name
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Location
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Birth Date
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    IP
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($users as $user)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div>
                                                        <label class="inline-flex items-center">
                                                            <input type="checkbox" name="{{$user->id}}" class="form-checkbox text-orange-600" />
                                                            <span class="ml-2">{{$user->email}}</span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{$user->id}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{$user->name}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{$user->country}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ date('d M, Y', strtotime($user->dob)) }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    {{$user->ip}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $users->links() }}
                                @else
                                    <h3>Sorry, No data found.</h3>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
