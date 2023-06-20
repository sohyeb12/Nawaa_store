<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

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
    public function store(Request $request)
    {
        $rules = $this->rules();
        $messages = $this->messages();
        $request->validate($rules,$messages);

        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

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
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = $this->rules();
        $messages = $this->messages();
        $request->validate($rules,$messages);

        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
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

    protected function messages(){
        return [
            'required'=> 'The Name field is Required',
            'min' => 'The minimum characters is 3 characters',
            'max' => 'the maximum characters is 50 characters'
        ];
    }

    protected function rules(){
        return [
            'name' => 'required|max:30|min:3',
        ];
    }
}
