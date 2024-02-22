@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('ab_test_variant') == 'Variant A')
            <h1>Welcome to Variant A!</h1>
            <!-- Display content specific to Variant A -->
        @elseif(session('ab_test_variant') == 'Variant B')
            <h1>Welcome to Variant B!</h1>
            <!-- Display content specific to Variant B -->
        @else
            <h1>Welcome to the default experience!</h1>
            <!-- Default content or content for other variants -->

            @isset($abTestId)
                @if(session('ab_test_status') == 'stopped')
                    <form action="{{ route('start-test', ['id' => $abTestId]) }}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-primary">Start A/B Test</button>
                    </form>
                @else
                    <form action="{{ route('stop-test', ['id' => $abTestId]) }}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-danger">Stop A/B Test</button>
                    </form>
                    <!-- Add other interactive elements or content when A/B test is running -->
                @endif
            @endisset
        @endif
    </div>
@endsection
