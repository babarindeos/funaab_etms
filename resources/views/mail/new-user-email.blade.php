<x-mail::message>
    @slot("header")
        <img src="{{ asset('images/logo.png')}}" alt="FUNAAB Logo" width="200" height="auto" />
    @endslot

# Welcome to FUNAAB WorkPlace
Where works happens....

Dear {{ $fullname }},

A Staff account has been created for you to facilitate your official work activities from 
anywhere at anytime. 

Please find below your access credentials:

**Username:** {{ $username }}

**Password:** {{ $password }}

<x-mail::button :url="'https://workplace.funaab.edu.ng/'">
 Go to WorkPlace
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
