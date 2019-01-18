<?php

namespace App\Http\Controllers;

use App\BasketItems;
use App\Basket;
use Illuminate\Http\Request;


class BasketItemsController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/basketitems/",
     *  
     *     tags={"Add Product"},
     * 
     *      @OA\Parameter(
     *         name="productId",
     *         in="query",
     *         description="Name",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\Parameter(
     *         name="quantity",
     *         in="query",
     *         description="Quantity",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *       @OA\Parameter(
     *         name="price",
     *         in="query",
     *         description="Price",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ), 
     *      @OA\Parameter(
     *         name="userId",
     *         in="query",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),        
     *     @OA\Response(
     *         response="200",
     *         description="Returns basketItem ",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function insert(Request $request)
    {
                
       $basketItem = new BasketItems;
       $basketItem->productId= $request->productId;
       $basketItem->price = $request->price;
       $basketItem->quantity= $request->quantity;
       $basketItem->userId = $request->userId;
       $basketItem->basketId = Basket::firstOrCreate(['userId' =>$request->userId,'IsCheckedOut' => 0],
                                ['IsCheckedOut' => 0])->id;

        $basketItem->save();
        return response()->json($basketItem);
     }
     /**
     * @OA\Get(
     *     path="/api/v1/basketitems/{id}",
     *  
     *     tags={"Basket"},
     * 
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User Id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *    
     *     @OA\Response(
     *         response="200",
     *         description="Returns Basket Items",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
     public function index(Request $request)
    {
     $basket = Basket::firstOrCreate(['userId' =>$request->userId],['IsCheckedOut' => 0]);
     $basketItems = BasketItems::where('basketId',$basket->id)->get();
     
     return response()->json($basketItems);
    }
    }
