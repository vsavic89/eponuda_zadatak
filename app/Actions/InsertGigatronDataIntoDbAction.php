<?php

namespace App\Actions;

class InsertGigatronDataIntoDbAction {

    private $catalogItems;

    public function __construct($catalogItems)
    {
        $this->catalogItems = $catalogItems;
    }

    public function prepareAndInsertData(){
        foreach($this->catalogItems as $item){
            foreach($item["_source"] as $key => $value){
                if(isset($value["product_id"])){                                        
                    $productId = $value["product_id"];                    
                    $ean = $value["ean"];
                    $name = $value["name"];
                    $brand = $value["brand"];
                    $brandId = $value["brand_id"];
                    $price = $value["price"] / 1000;
                    $imageUrl = $value["image"];                                    
                    
                    $this->insertDataIntoDb(
                        $productId,
                        $ean,
                        $name,
                        $brand,
                        $brandId,
                        $price,
                        $imageUrl
                    );
                }
            }
        }
    }

    private function insertProduct(
        $productId,
        $ean,
        $name,
        $price,
        $imageUrl
    ){
        return \App\Gigatron\Product::updateOrCreate(
            [
                'id' => $productId
            ],
            [
                'id' => $productId,
                'ean' => $ean,
                'name' => $name,
                'price' => $price,
                'image_url' => $imageUrl
            ]);
    } 
    
    private function insertBrand(
        $brandName,
        $brandId
    ){        

        return \App\Gigatron\Brand::updateOrCreate(
            [
                'id' => $brandId
            ],
            [
                'id' => $brandId,                
                'name' => $brandName                
            ]);
    }  

    private function insertBrandProduct(
        $brand,
        $product
    ){        

        return \App\Gigatron\BrandProduct::updateOrCreate(
            [
                'brand_id' => $brand->id,
                'product_id' => $product->id
            ],
            [
                'brand_id' => $brand->id,
                'product_id' => $product->id        
            ]);
    }  

    private function insertDataIntoDb(
        $productId,
        $ean,
        $name,
        $brand,
        $brandId,
        $price,
        $imageUrl
    ){
        $product = $this->insertProduct(
            $productId,
            $ean,
            $name,            
            $price,
            $imageUrl
        );                
        
        $brand = $this->insertBrand(
            $brandId,
            $brand
        );            

        if($product && $brand){                
            $this->insertBrandProduct($brand, $product);
        }
    }
}