@extends('master')
@section('content')        
    @if(count($gigatronProducts) > 0)  
        <h1>List of products</h1>
        <table class="table table-responsive border">            
            <tr>
                <th>Image</th>
                <th>Product Id</th>
                <th>Product Name</th>            
                <th>EAN</th>
                <th>Brand</th>
                <th>Price</th>
            </tr>
            @foreach($gigatronProducts as $product)
                <tr>                    
                    <td><a href="{{ $product->image_url }}" target="_blank"><img src="{{ $product->image_url }}"/></a></td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>   
                    <td>{{ $product->ean }}</td>
                    <td>{{ $product->brand->name }}</td>
                    <td class="price">{{ $product->price }}</td>                 
                </tr>
            @endforeach
        </table>
        {{ $gigatronProducts->links() }}
    @else
        <h1>No records to show.</h1>
    @endif    
@endsection