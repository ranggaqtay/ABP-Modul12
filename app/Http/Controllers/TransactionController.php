<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Display a list of transactions (Read)
    public function index()
    {
        // Retrieve all transactions with related customer and product data
        $transactions = Transaction::with(['customer', 'product'])->paginate(10);

        // Return the view with the transaction data
        return view('transactions.index', compact('transactions'));
    }

    // Show the form to create a new transaction (Create)
    public function create()
    {
        // Retrieve all customers and products for the select form
        $customers = Customer::all();
        $products = Product::all();

        // Return the view to display the form
        return view('transactions.create', compact('customers', 'products'));
    }

    // Store a new transaction in the database (Store)
    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
        ]);

        // Calculate the total price
        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        // Save the transaction to the database
        Transaction::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'total_price' => $totalPrice,
            'transaction_date' => $request->transaction_date,
        ]);

        // Redirect to the transaction list with a success message
        return redirect()->route('transactions.index')->with('success', 'Transaction successfully added.');
    }

    // Show the form to edit an existing transaction (Edit)
    public function edit($id)
    {
        // Find the transaction by ID
        $transaction = Transaction::findOrFail($id);

        // Retrieve all customers and products for the select form
        $customers = Customer::all();
        $products = Product::all();

        // Return the view to edit the transaction
        return view('transactions.edit', compact('transaction', 'customers', 'products'));
    }

    // Update an existing transaction in the database (Update)
    public function update(Request $request, $id)
    {
        // Validate form input
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
        ]);

        // Calculate the total price
        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        // Find the transaction by ID
        $transaction = Transaction::findOrFail($id);

        // Update the transaction in the database
        $transaction->update([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'total_price' => $totalPrice,
            'transaction_date' => $request->transaction_date,
        ]);

        // Redirect to the transaction list with a success message
        return redirect()->route('transactions.index')->with('success', 'Transaction successfully updated.');
    }

    // Delete a transaction from the database (Delete)
    public function destroy($id)
    {
        // Find the transaction by ID
        $transaction = Transaction::findOrFail($id);

        // Delete the transaction from the database
        $transaction->delete();

        // Redirect to the transaction list with a success message
        return redirect()->route('transactions.index')->with('success', 'Transaction successfully deleted.');
    }
}