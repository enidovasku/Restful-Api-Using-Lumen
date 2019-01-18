<?php

class ProductTest extends TestCase
{
    public function testShouldReturnAllProducts(){
        $this->get("api/v1/product", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            [
                'name',
                'description',
                'created_at',
                'updated_at',
                'quantity'
            ]
        ]);        
    }
    public function testCreateProduct(){
        $parameters = [
            'name' => 'prod Test',
            'description' => ' prod Test Descp',
            'quantity'=> 123,
            'price'=>123
        ];
        $this->post("api/v1/product", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
             [
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                    'quantity',
                    'price'
                ]               
        );   
    }
}