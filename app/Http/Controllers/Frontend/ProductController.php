<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AttributeGroup;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct($id)
    {
        $product=Product::with(['photos','attributeValues.attributeGroup','brand','categories'])->whereId($id)->first();
        $relatedProducts=Product::with('categories')->whereHas('categories',function ($q)use($product){
            $q->whereIn('id',$product->categories);
        })->get();
        return view('frontend.products.index',compact(['product','relatedProducts']));
    }

    public function getProductByCategory($id)
    {
        $category=Category::whereId($id)->first();
        return view('frontend.categories.index',compact(['category']));
    }
    public function apiGetProduct($id)
    {
        $products=Product::with('photos')->whereHas('categories',function ($q)use($id){
            $q->where('id',$id);
        })->paginate(10);
        $response=[
            'products'=>$products
        ];
        return response()->json($response,200);

    }
    public function apiGetSortedProduct($id,$sort,$paginate)
    {
        $products=Product::with('photos')->whereHas('categories',function ($q)use($id){
            $q->where('id',$id);
        })->orderBy('price',$sort)
            ->paginate($paginate);
        $response=[
            'products'=>$products
        ];
        return response()->json($response,200);

    }

    public function apiGetCategoryAttributes($id)
    {
        $attributeGroups=AttributeGroup::with('attributeValue')
            ->whereHas('categories',function ($q)use ($id){
                $q->where('category_id',$id);
            })->get();
        $response=[
            'attributeGroups'=>$attributeGroups
        ];
        return response()->json($response,200);

    }

    public function apiGetFilterProducts($id,$sort,$paginate,$attributes)
    {
        $attributesArray=json_decode($attributes,true);
        $products=Product::with('photos')->whereHas('categories',function ($q)use($id){
            $q->where('id',$id);
        })->whereHas('attributeValues',function ($q)use ($attributesArray){
            $q->whereIn('attributeValue_id',$attributesArray);
        })
            ->orderBy('price',$sort)
            ->paginate($paginate);
        $response=[
            'products'=>$products
        ];
        return response()->json($response,200);

    }
}
