<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a paginated list of products
    public function index()
    {
        // Retrieve all products with their related category, paginated by 10
        $products = Product::with('category')->paginate(10);

        // Return the product index view
        return view('products.index', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        // Retrieve all categories to populate the select input
        $categories = Category::all();

        // Return the create view with category data
        return view('products.create', compact('categories'));
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^(?![-\s]*$).+$/'
            ],
            'description' => [
                'required',
                'string',
                'regex:/^(?![-\s]*$).+$/'
            ],
            'price' => 'required|numeric|gt:0',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required' => 'Product name is required.',
            'name.regex' => 'Product name cannot contain only spaces or hyphens.',
            'description.required' => 'Product description is required.',
            'description.regex' => 'Description cannot contain only spaces or hyphens.',
            'price.required' => 'Product price is required.',
            'price.numeric' => 'Price must be a number.',
            'price.gt' => 'Price must be greater than 0.',
            'category_id.required' => 'Category must be selected.',
            'category_id.exists' => 'The selected category is invalid.',
        ]);

        // Create the product
        Product::create($request->all());

        // Redirect with a success message
        return redirect()->route('products.index')->with('success', 'Product has been successfully added.');
    }

    // Show the form for editing the specified product
    public function edit($id)
    {
        // Find the product by ID or throw 404
        $product = Product::findOrFail($id);

        // Retrieve all categories
        $categories = Category::all();

        // Return the edit view with product and category data
        return view('products.edit', compact('product', 'categories'));
    }

    // Update the specified product in the database
    public function update(Request $request, $id)
    {
        // Validate the form input
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^(?![-\s]*$).+$/'
            ],
            'description' => [
                'required',
                'string',
                'regex:/^(?![-\s]*$).+$/'
            ],
            'price' => 'required|numeric|gt:0',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required' => 'Product name is required.',
            'name.regex' => 'Product name cannot contain only spaces or hyphens.',
            'description.required' => 'Product description is required.',
            'description.regex' => 'Description cannot contain only spaces or hyphens.',
            'price.required' => 'Product price is required.',
            'price.numeric' => 'Price must be a number.',
            'price.gt' => 'Price must be greater than 0.',
            'category_id.required' => 'Category must be selected.',
            'category_id.exists' => 'The selected category is invalid.',
        ]);

        // Find the product by ID or throw 404
        $product = Product::findOrFail($id);

        // Update the product
        $product->update($request->all());

        // Redirect with a success message
        return redirect()->route('products.index')->with('success', 'Product has been successfully updated.');
    }

    // Delete the specified product from the database
    public function destroy($id)
    {
        // Find the product by ID or throw 404
        $product = Product::findOrFail($id);

        // Delete the product
        $product->delete();

        // Redirect with a success message
        return redirect()->route('products.index')->with('success', 'Product has been successfully deleted.');
    }
}