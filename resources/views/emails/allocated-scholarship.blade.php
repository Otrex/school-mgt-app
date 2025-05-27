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


# **Scholarship Granted!**

Your scholarship has been granted to **{{ $scholar->first_name }}** **{{ $scholar->last_name }}** from the town **{{ $scholar->town }}**.
Thank you for your contributions.

Follow us on Twitter [@BlipSchool](https://x.com/BlipSchool) for tech content! Let's collaborate and innovate together!

Get ready for a learning adventure. Invite your friends to join and earn 100 Naira for each referral! Spread the joy of knowledge. Let's start earning.

Come join us as we shape a future!


{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{ config('app.name') }}
@endif

</x-mail::message>

