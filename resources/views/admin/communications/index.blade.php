@extends('layouts.admin')

@section('content')
<header class="mb-4 d-flex">
    <h2 class="mb-4 fs-3"> {{ $title }} </h2>
</header>
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif



<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Subject</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        @foreach($communications as $communication)
        <tr>
            <td>{{ $communication->id }}</td>
            <td>{{ $communication->name }}</td>
            <td>{{ $communication->subject }}</td>
            <td>{{ $communication->email }}</td>
            <td>{{ $communication->phone }}</td>
            <td>{{ $communication->message }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div>
    {{ $communications->links() }}
</div>
@endsection