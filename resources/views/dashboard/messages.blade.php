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
                <h2><strong>All your pre-selected messages.</strong></h2>
                <br>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Message</th>
                        <th scope="col">DELETE</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $message)
                        <tr>
                            <td>{{ $message->message  }}</td>
                            <td style="width: 24px;">
                                <form action="/dashboard/{{ $message->id }}/messages" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" style="background: url('/img/delete.svg') no-repeat; background-size: 30px; min-height: 30px; min-width: 30px;"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Message</span>
                    </div>
                    <textarea name="message" form="new" class="form-control" aria-label="Message"></textarea>
                </div>
                <br>
                <form id="new" method="post" action="/dashboard/{{ $site_id }}/messages">
                    @csrf
                    <button class="btn btn-primary btn-block" type="submit">Add</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if(isset($errors))
        <script>
            swal({
                title: 'Validation Error',
                text: @foreach($errors as $error) ' {{ $error  }}  ', @endforeach
                icon: 'error'

            })
        </script>
    @endif

@endsection