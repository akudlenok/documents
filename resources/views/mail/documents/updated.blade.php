<x-mail::message>
    # Document Updated

    {{$userName}}, document "{{$title}}" has been updated!

    <x-mail::button :url="$url">
        View Document
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
