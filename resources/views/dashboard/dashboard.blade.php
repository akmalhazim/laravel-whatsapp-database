@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-2">
                <ul class="list-unstyled">
                    <li><a href="#" class="">Records</a></li>
                    <li><a href="#" class="">Messages</a></li>
                    <li><a href="#" class="">Settings</a></li>
                </ul>
            </div>
            <div class="col-lg-10">
                <h2><strong>What you have so far.</strong></h2>
                <br>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <th>{{ $record->name  }}</th>
                            <td>{{ $record->phone_number }}</td>
                            <td>{{ $record->email  }}</td>
                            <td>{{ $record->message  }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection