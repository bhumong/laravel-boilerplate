@section('title', 'Dashboard')

<x-admin::app-layout>
    <x-admin::breadcrumbs>
        <x-slot:title>
            Dashboard
        </x-slot>
    </x-admin::breadcrumbs>
    <x-admin::card>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 underline text-teal-400">
                        You're logged in!!!
                    </div>
                </div>
            </div>
        </div>
    </x-admin::card>
</x-admin::app-layout>
