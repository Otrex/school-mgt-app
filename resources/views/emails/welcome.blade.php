<x-mail::message>
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
 @lang('Hello!') {{ $first_name }}
@endif
@endif

{{-- Intro Lines --}}
{{-- @foreach ($introLines as $line)
{{ $line }}

@endforeach --}}


# **Welcome to Blip School!**

Prepare yourself for a journey into the world of technology. Come join our community on WhatsApp for updates and direct interactions: [Link to WhatsApp group](https://chat.whatsapp.com/HNVMQ7z2m965jUwgvmj6u3). 

Stay connected to catch up on tech news and gain insights. Follow us on Twitter [@BlipSchool](https://x.com/BlipSchool) for tech content! Let's collaborate and innovate together!

Get ready for a learning adventure. Invite your friends to join and earn 100 Naira for each referral! Spread the joy of knowledge. Let's start earning.

Come join us as we shape a future!


{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{ config('app.name') }}
@endif


<x-slot:subcopy>
@lang(
    "If you're having trouble clicking the \"Whatsapp\" link, copy and paste the URL below\n".
    'into your web browser:',
) <span> [https://chat.whatsapp.com/HNVMQ7z2m965jUwgvmj6u3](https://chat.whatsapp.com/HNVMQ7z2m965jUwgvmj6u3) <span>
</x-slot:subcopy>

</x-mail::message>

