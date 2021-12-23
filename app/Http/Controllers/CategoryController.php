<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat(){
        //eloquent orm read data
        $categories = DB::table('categories')
            ->join('users', 'categories.user_id', 'users.id')
            ->select('categories.*', 'users.name')
            ->latest()->paginate(5);
        // $categories = Category::latest()->paginate(5);
        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }


    public function AddCat(Request $request) {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        
        ],

          [  'category_name.required' => 'please input category name',
        
        ]);

        // now we need to erify this data 
        // we need the data above and the name of the input field 
        Category::insert([
            'category_name' => $request->category_name,
            //auth = this authenticeated user that has logged n
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success','Category Insert Successfull');
    }
}
