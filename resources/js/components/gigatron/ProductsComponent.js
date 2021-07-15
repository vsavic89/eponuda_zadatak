import React from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.css';
import '../../../../public/css/app.css';
import {Pagination} from 'react-laravel-paginex'

function ProductsComponent(props) {
    return (
        <div className="container">            
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header">List of Gigatron products (laptops)</div>

                        <div className="card-body">                            
                            {ShowTable(props)}    
                            {ShowPagination(JSON.parse(props.products))}
                        </div>                                            
                    </div>
                </div>
            </div>
        </div>
    );
}

function ShowPagination(data){
    return (<Pagination changePage={getData} data={data}/>)
}

function getData(data){
    axios.get('?page=' + data.page).then(response => {        
        this.setState({props: JSON.stringify(response.data)});
    });
}

function ShowTable(props){
    if(props.products.length == 0) return '';
    return (
        <table className="table border">
            <tbody>
            <tr>                
                <th>Image</th>
                <th>Product Id</th>
                <th>Product Name</th>
                <th>EAN</th>
                <th>Brand</th>
                <th>Price</th>                
            </tr>                      
            {ShowItems(props)}   
            </tbody>            
        </table>        
    );
}

function ShowItems(props){    
    var products = JSON.parse(props.products).data;    
    var namesList = products.map(function(product, index){                     
                    return  <tr  key={ index }>
                                <td>
                                    <a href={ product.image_url } target="_blank">
                                        <img className="product-image" src={ product.image_url }/>
                                    </a>
                                </td>
                                <td>{ product.id }</td>
                                <td>{ product.name }</td>
                                <td>{ product.ean }</td>
                                <td>{ product.brand.name }</td>
                                <td className="price">{ product.price }</td>
                            </tr>;
                })    
                
    return ( namesList );    
}

export default ProductsComponent;

if (document.getElementById('products-component')) {

    const element = document.getElementById('products-component')

    var props = Object.assign({}, element.dataset)    

    ReactDOM.render(<ProductsComponent {...props}/>, element);
}