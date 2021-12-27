<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    
    public function AllBrand(){

        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }


    public function StoreBrand(Request $request) {
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg.jpeg,png',

        ],

          [ 
            'brand_name.required' => 'please input Brand name',
            'brand_name.min' => 'Brand longer than 4 characters',

        

          ]);


          $brand_image = $request->file('brand_image');
          // this gets the name and extension of the omage file and saves it to a veriable 
          $name_gen = hexdec(uniqid());
          $img_ext = strtolower($brand_image->getClientOriginalExtension());
          $img_name = $name_gen.'.'.$img_ext;
          // now we upload it, first the location 
          $up_location = 'image/brand/';
          // then save the name and location to a variable 
          $last_img = $up_location.$img_name;
          $brand_image->move($up_location,$img_name);


          Brand::insert([
              'brand_name' => $request->brand_name,
              'brand_image' => $last_img,
              'created_at' => Carbon::now(),
          ]);

          return Redirect()->back()->with('success', 'Brand Inserted Successfully');
    }

    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function Update(Request $request, $id){
        $validateData = $request->validate([
            'brand_name' => 'required|min:4',

        ],

          [ 
            'brand_name.required' => 'please input Brand name',
            'brand_name.min' => 'Brand longer than 4 characters',

        

          ]);

          $old_image = $request->old_image;

          $brand_image = $request->file('brand_image');

          if($brand_image) {
                      // this gets the name and extension of the omage file and saves it to a veriable 
          $name_gen = hexdec(uniqid());
          $img_ext = strtolower($brand_image->getClientOriginalExtension());
          $img_name = $name_gen.'.'.$img_ext;
          // now we upload it, first the location 
          $up_location = 'image/brand/';
          // then save the name and location to a variable 
          $last_img = $up_location.$img_name;
          $brand_image->move($up_location,$img_name);

          unlink($old_image);
          Brand::find($id)->update([
              'brand_name' => $request->brand_name,
              'brand_image' => $last_img,
              'created_at' => Carbon::now(),
          ]);

          return Redirect()->back()->with('success', 'Brand updated Successfully');
          }else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ]);
  
            return Redirect()->back()->with('success', 'Brand updated Successfully');
          }


    }


}
