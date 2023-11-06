@component('mail::message')
  
<h2>
    {{ $data['title'] }}
</h2>

<h4>
    {{ $data['sub_title'] }}
</h4>

<p>
    {{ $data['status'] }}
</p>

<p>
    {{ $data['info'] }}
</p>
    
@component('mail::button', ['url' => $data['url']])
Login
@endcomponent
    

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent