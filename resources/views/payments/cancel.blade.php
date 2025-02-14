@php
    $hideWelcomeSection = true;
    $hideFooterSection = true;
@endphp

@extends('layouts.app')

@section('content')
    @include('components.payment-cancel') 
@endsection
