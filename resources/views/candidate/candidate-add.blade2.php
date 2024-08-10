@extends('template.main')
@section('title', 'Cadastro Online')
@section('content')

    <!-- Add Select2 CSS and JS in the head section -->
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#options').select2();
        });
    </script>
    @endpush

    <!-- Your content -->
    <select id="options" style="width: 300px;">
        <option value="1">Apple</option>
        <option value="2">Banana</option>
        <option value="3">Cherry</option>
        <option value="4">Date</option>
        <option value="5">Fig</option>
        <option value="6">Grape</option>
        <option value="7">Kiwi</option>
        <option value="8">Lemon</option>
        <option value="9">Mango</option>
        <option value="10">Orange</option>
    </select>

@endsection
