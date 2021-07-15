@extends('master')
@section('content')    
  <div id="products-component" data-products="{{ json_encode($gigatronProducts) }}" >
  </div>
@endsection