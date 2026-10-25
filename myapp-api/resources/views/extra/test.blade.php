@php
    $name = 'Selim';
    $arr = ['Selim', 'Sakib', 'Rifat'];
    $active = true;
@endphp
@foreach ($arr as $item)
    {!!  $item . "<br>" !!}
@endforeach

<h1>Test Page</h1>
<!-- <p>Hello, @php #echo e($name); @endphp! </p> -->
<p>Hello, {{ $name }}!</p>
<p><b>Status: </b>{{ $active ? "Active" : "Inactive" }} </b></p>