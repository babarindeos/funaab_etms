<x-mail::message>
    @slot("header")
        <img src="{{ asset('images/logo.png')}}" alt="FUNAAB Logo" width="200" height="auto" />
    @endslot

# Welcome to Exam Time-table Management System (ETMS)
Everything exam scheduling and management...

Dear {{ $fullname }},

A Staff account has been created for you on the Exam Time-table Management System (ETMS).

Please find below your access credentials:

**Username:** {{ $username }}

**Password:** {{ $password }}

<x-mail::button :url="'https://etms.funaab.edu.ng/'">
 Go to ETMS Portal
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
