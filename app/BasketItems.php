<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;


class BasketItems extends Model{
    
    protected $table = "basket_items";

    protected $fillable = [ 'productId','quantity','price'];
}