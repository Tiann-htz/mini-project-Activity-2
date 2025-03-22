<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Get count of suppliers
     */
    public function count()
    {
        $count = Supplier::count();
        return response()->json(['count' => $count]);
    }

    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers', compact('suppliers')); // Changed to plural
    }

    // Rest of the controller remains the same
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        Supplier::create($validated);

        return response()->json(['success' => 'Supplier added successfully!']);
    }

    public function show(Supplier $supplier)
    {
        return response()->json($supplier);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier->update($validated);

        return response()->json(['success' => 'Supplier updated successfully!']);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->json(['success' => 'Supplier deleted successfully!']);
    }
}
