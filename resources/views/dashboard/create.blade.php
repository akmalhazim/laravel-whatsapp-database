@extends('layouts.app')
@section('content')
    <div class="container">
        {{--<div @if ($errors->any()) class="row justify-content-center">--}}
            {{--<div class="col-lg-6 alert alert-warning" role="alert">--}}
                {{--@foreach($errors as $error)--}}
                    {{--<h2>{{ $error }}</h2>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div @endif>--}}
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form method="post" action="{{ route('newSite') }}" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="siteName">Site Name (This can't be changed)</label>
                        <input name="name" type="text" class="form-control" id="siteName" placeholder="Holla">
                        <label for="siteName">Site Path</label>
                        <input name="path" type="text" class="form-control" id="siteName" placeholder="/kambing">
                        @csrf
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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