@extends('master')
@section('content')    
  <products-component 
    :products="{{ json_encode($gigatronProducts) }}"
  >  
  </products-component>  
@endsection