<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/product/",
     *  
     *     tags={"Products"},
     *    
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function index()
    {        
     $products = Product::all();
     return response()->json($products);
    }
    /**
     * @OA\Post(
     *     path="/api/v1/product/",
     *  
     *     tags={"Create Product"},
     * 
     *      @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Description",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *       @OA\Parameter(
     *         name="price",
     *         in="query",
     *         description="Price",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *       @OA\Parameter(
     *         name="quantity",
     *         in="query",
     *         description="Quantity",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *    
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function create(Request $request)
     {
        $product = Product::create($request->all());
        return response()->json($product, 200);
     }

     public function show($id)
     {
        $product = Product::find($id);
        return response()->json($product);
     }

     public function update(Request $request, $id)
     { 
        $product= Product::find($id);
        
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $product->save();
        return response()->json($product);
     }

     public function destroy($id)
     {
        $product = Product::find($id);
        $product->delete();
        return response()->json('product removed successfully');
     }
    }
