<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function search(Request $request)
    {
        $data = $request->all();
        $sorting='created_at';
        $type='DESC';
        if (!empty($data['all_sorttings']) && $data['all_sorttings'] != '' && $data['all_sorttings'] != 'undefined') {
            if ($data['all_sorttings']==1) {
                $sorting='product_name';
            $type='ASC';
            }
            else if ($data['all_sorttings']==2) {
                $sorting='product_name';
            $type='DESC';
            }
            else if ($data['all_sorttings']==3) {
                $sorting='product_after_discount_price';
            $type='ASC';
            }
            else if ($data['all_sorttings']==4) {
                $sorting='product_after_discount_price';
            $type='DESC';
            }
        }

        // paginate(6);
        $all_search_products = Product::where(function ($q) use ($data) {

                $min = 0;
                if (!empty($data['min']) && $data['min'] != '' && $data['q'] != 'undefined') {

                    $min = $data['min'];
                } else {
                    $min = 1;
                }
                if (!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined') {
                    $q->where(function ($q) use ($data) {
                        $q->where('product_name', 'like', '%' . $data['q'] . '%');
                        $q->OrWhere('long_description', 'like', '%' . $data['q'] . '%');
                    });
                }
                if (!empty($data['min']) && $data['min'] != '' && $data['q'] != 'undefined' || !empty($data['max']) && $data['max'] != '' && $data['q'] != 'undefined') {
                    $q->whereBetween('product_after_discount_price', [$min, $data['max']]);
                }
                if (!empty($data['category_id']) && $data['category_id'] != '' && $data['category_id'] != 'undefined') {
                    $q->where('category_id',  $data['category_id']);
                }
                if (!empty($data['brands']) && $data['brands'] != '' && $data['brands'] != 'undefined') {
                    $q->where('brand',  $data['brands']);
                }
                if (!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined'||!empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined') {
                    $q->whereHas('relation_to_sub_inventory_for_searching', function($q)use ($data) {
                        if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined'){
                            $q->whereHas('relation_to_color', function($q)use ($data) {
                                $q->where('id',$data['color_id']);
                            });
                        }
                        if(!empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined'){
                            $q->whereHas('relation_to_size', function($q)use ($data) {
                                $q->where('id',$data['size_id']);
                            });
                        }

                    });
                }

        })->orderBy($sorting,$type)->paginate(12);
        //
        $categorys = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $brands = Brand::all();
        return view('frontend\search', [
            'all_search_products' => $all_search_products,
            'categorys' => $categorys,
            'colors' => $colors,
            'sizes' => $sizes,
            'brands' => $brands,
        ]);
    }
}
