<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $cateogry = Category::all();
        View::share([
            'category' => $cateogry,
            'status_options' => Product::status_option(),
        ]);
    }

    public function index(Request $request)
    {
        //
        // SELECT * FROM PRODUCTS
        // $products = DB::table('products')->get(); // Collection Object = array 
        $products = Product::leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->select(['products.*', 'categories.name as category_name',])
            // ->withoutGlobalScope('owner')  //we use it to reject the Global Scope 
            // ->active()
            // ->status('archived')
            // ->when($request->search ?? false , function($query , $value){
            //     $query->where(function ($query) use ($value){
            //         $query->where('products.name' , 'LIKE' , "%{$value}%")
            //     ->orWhere('products.description' , 'LIKE' , "%{$value}%");
            //     });
                
            // })
            // ->when($request->status ?? false , function($query , $value){
            //     $query->where('products.status' , '=' , $value);
            // })
            // ->when($request->category_id ?? false , function ($query , $value){
            //     $query->where('products.category_id' , '>=' , $value);
            // })
            // ->when($request->price_min ?? false , function ($query , $value){
            //     $query->where('products.price' , '>=' , $value);
            // })
            // ->when($request->price_max ?? false , function ($query , $value){
            //     $query->where('products.compare_price' , '<=' , $value);
            // })
            ->filter($request->query())
            ->paginate(5); // paginate function show the index 

        return view('admin.products.index', [
            'title' => 'Products List',
            'products' => $products,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cateogry = Category::all();
        return view('admin.products.create', [
            'product' => new Product(), 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // $rules = $this->rules();
        // $messages = $this->messages();
        // $request->validate($rules,$messages);

        // mass assignment in the next line
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/images', 'public');
            $data['image'] = $path;
        }
        $data['user_id'] = Auth::id();
        $product = Product::create($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/images', 'public'),
                ]);
            }
        }
        // $product_1 = Product::create($request->only('name','slug'));
        // $product_2 = Product::create($request->except('name','slug'));

        // $product = new Product();
        // $product->name = $request->input('name');
        // $product->price = $request->input('price');
        // $product->category_id = $request->input('category_id');
        // $product->compare_price = $request->input('compare_price');
        // $product->slug = $request->input('slug');
        // $product->description = $request->input('description');
        // $product->short_description = $request->input('short_description');
        // $product->status = $request->input('status', 'active');
        // $product->save();

        // prg : post redirect get 
        return redirect()->route('products.index')->with('success', "Product ({$product->name}) Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // $product = Product::findOrFail($id);
        // if(!$product){
        //     abort(404);
        // }
        $gallery = ProductImage::where('product_id', '=', $product->id)->get();
        
        return view('admin.products.edit', [
            'product' => $product,
            'gallery' => $gallery,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        // $rules = $this->rules($id);
        // $messages = $this->messages();
        // $request->validate($rules,$messages);

        // $product = Product::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/images', 'public');
            $data['image'] = $path;
        }
        $old_image = $product->image;
        $product->update($data);

        if ($old_image && $old_image != $product->image) {
            Storage::disk('public')->delete($old_image);
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/images', 'public'),
                ]);
            }
        }

        $old_image = $product->image;
        $product->update($data);

        // $product->name = $request->input('name');
        // $product->price = $request->input('price');
        // $product->category_id = $request->input('category_id');
        // $product->compare_price = $request->input('compare_price');
        // $product->slug = $request->input('slug');
        // $product->description = $request->input('description');
        // $product->short_description = $request->input('short_description');
        // $product->status = $request->input('status', 'active');
        // $product->save();

        // prg : post redirect get 
        return redirect()->route('products.index')->with('success', "Product ({$product->name}) Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Product::where('id','=',$id)->delete();
        // Product::destroy($id);
        // $product = Product::findOrFail($id);
        $product->delete();
        
        // dd(Product::destroy($id));
        return redirect()->route('products.index')->with('success', "Product ({$product->name}) Deleted");
    }
    
    public function trashed()
    {
        $product = Product::onlyTrashed()->paginate();

        return view('admin.products.trashed' ,[
            'products' => $product ,
        ]);

    }

    public function restore($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('products.index')
        ->with('success', "Product ({$product->name}) Restored");
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        return redirect()->route('products.index')
        ->with('success', "Product ({$product->name}) Deleted forever!");
    }

    // protected function messages(){
    //     return [
    //         'required' => ':attribute field is requied!!',
    //         'unique' => 'The value already exists !',
    //         'name.required' => 'The product name is required',
    //     ];
    // }

    // protected function rules($id = 0){
    //     return [
    //         'name' => 'required|max:255|min:3',
    //         'slug' => "required|unique:products,slug,$id",
    //         'category_id' => 'nullable|int|exists:categories,id',
    //         'description' => 'nullable|string',
    //         'short_description' =>  'nullable|string|max:500',
    //         'price' => 'required|numeric|min:0',
    //         'compare_price' => 'numeric|min:0|gt:price',
    //         'image' => 'nullable|image|dimensions:min_width=400,min-height:300|max:1024',
    //         'status' => 'required|in:active,draft,archived',
    //     ];
    // }
}
