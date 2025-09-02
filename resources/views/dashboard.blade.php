<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("What can you do after logging in?") }}
                </div>
                <div class="p-6 text-gray-900">
                    {{ __("By logging in, you can access more information from the Group Company, Corporate Profile, Shareholder, and Sustainability Risk Assessment (SRA).") }}
                </div>
                <div class="p-6 text-gray-900">
                    {!! __("To access these features, please go back to the <a href=':url' style='color: blue;'>landing page</a> and enter the services menu.", ['url' => route('corporateProfileEn')]) !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>