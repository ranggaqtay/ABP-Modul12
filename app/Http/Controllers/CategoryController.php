<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a listing of the categories
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('categories.create');
    }

    // Store a newly created category in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^(?![-\s]*$).+$/',
            ],
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Category name is required.',
            'name.regex' => 'Category name cannot be empty, contain only spaces, or just the "-" character.',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category successfully added.');
    }

    // Show the form for editing the specified category
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Update the specified category in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^(?![-\s]*$).+$/',
            ],
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Category name is required.',
            'name.regex' => 'Category name cannot be empty, contain only spaces, or just the "-" character.',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category successfully updated.');
    }

    // Remove the specified category from the database
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category successfully deleted.');
    }
}