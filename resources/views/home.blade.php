<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">--}}

</head>
<body >
    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                   South African Public Holidays
                </a>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-6">
                <form class="form-inline" method="POST" action="/home">
                    @csrf

                    <select class=" form-control form-select" aria-label=".form-select-sm example" name="year" id="year">

                        <option selected>Select Year</option>


                        {{ $iniYear = 2013 }}

                        @for($x = 0; $x <= 50; $x++)

                            <option value="{{ $iniYear }}">{{ $iniYear }}</option>

                            {{ $iniYear++ }}

                        @endfor

                    </select>

                    <button class="btn btn-success">Fetch Holidays</button>
                </form>
            </div>

            <div class="col-md-6">
                <a href="{{ URL::to('/downloadpdf') }}" class="btn btn-primary">Download</a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        South Africa Public Holidays
                    </div>
                    <div class="card-body">

                        @if(isset($publicholidays))

                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                <div>
                                    Public holidays retrieved succefully.
                                </div>
                            </div>

                            <table class="table table-striped">
                                <thead>
                                <td>Date</td>
                                <td>Month</td>
                                <td>Year</td>
                                <td>Day Of Week</td>
                                <td>Public Holiday Description</td>
                                </thead>
                                <tbody>
                                @foreach($publicholidays as $publicholiday)

                                    <tr>
                                        <td>{{ $publicholiday['date']['day'] }}</td>
                                        <td>{{ $publicholiday['date']['month'] }}</td>
                                        <td>{{ $publicholiday['date']['year'] }}</td>
                                        <td>{{ $publicholiday['date']['dayOfWeek'] }}</td>
                                        <td>{{ $publicholiday['name'][0]['text'] }}</td>
                                    </tr>

                                @endforeach
                                </tbody>

                            </table>
                        @else
                            <h2>Select the year above and click the "Fetch Holidays" button</h2>
                        @endif

                    </div>
                </div>

            </div>
        </div>


    </div>
</body>
</html>
