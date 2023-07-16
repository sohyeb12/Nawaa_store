<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::all()->toQuery()->paginate(7);
        $categories = Category::withCount('products')->paginate(5);
        return view('admin.categories.index',[
            'intro' => 'Category List',
            'categories' => $categories,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create',[
            'category' => new Category(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // $rules = $this->rules();
        // $messages = $this->messages();
        // $request->validate($rules,$messages);

        $data = $request->validated();
        
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = $file->store('uploads/images', 'public');
            $data['image'] = $path;
        }

        $category = Category::create($data);

        return redirect()->route('categories.index')->with('done',"Category ({$category->name}) Created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // $category = Category::findOrFail($id);
        return view('admin.categories.edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = $file->store('uploads/images', 'public');
            $data['image'] = $path;
        }

        $old_image = $category->image;
        $category->update($data);

        if ($old_image && $old_image != $category->image) {
            Storage::disk('public')->delete($old_image);
        }

        $category->save();

        return redirect()->route('categories.index')->with('done', "Category ({$category->name}) Updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('done',"Category ({$category->name}) Deleted.");;
    }

    public function trashed()
    {
        $categories = Category::onlyTrashed()->paginate();

        return view('admin.categories.trashed' ,[
            'categories' => $categories ,
        ]);

    }

    public function restore($id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('categories.index')
        ->with('success', "Product ({$category->name}) Restored");
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        
        return redirect()->route('categories.index')
        ->with('success', "Product ({$category->name}) Deleted forever!");
    }


    // protected function messages(){
    //     return [
    //         'required'=> 'The Name field is Required',
    //         'min' => 'The minimum characters is 3 characters',
    //         'max' => 'the maximum characters is 50 characters'
    //     ];
    // }

    // protected function rules(){
    //     return [
    //         'name' => 'required|max:30|min:3',
    //         'image' => 'nullable|image|dimensions:min_width=400,min-height:400|max:1024',
    //     ];
    // }
}
