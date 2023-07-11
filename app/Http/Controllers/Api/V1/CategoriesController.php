<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all()->toQuery()->paginate(7);
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

        return [
            'message' => 'Catergory Created successfully!',
            'category' => $category,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Category::findOrFail($id);
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

        return [
            'message' => 'Catergory Updated successfully!',
            'category' => $category,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id)->delete();;
        
        return [
            'message'=>'Category Deleted successfully!',
        ];
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
