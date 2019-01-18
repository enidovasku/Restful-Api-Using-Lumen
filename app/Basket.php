<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;
class Basket extends Model{
    protected $fillable = ['basketId', 'userId', 'isCheckedOut'];
    protected $hidden   = ['CreatedAt', 'UpdatedAt'];
}