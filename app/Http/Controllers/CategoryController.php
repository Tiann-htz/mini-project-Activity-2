<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Get count of categories
     */
    public function count()
    {
        $count = Category::count();
        return response()->json(['count' => $count]);
    }

    public function index()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }


     

    /**
     * Get categories with medicine count
     */
    public function getCategoriesWithMedicineCount()
    {
        $categories = Category::select('categories.*')
            ->selectSub(
                DB::table('category_medicine')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('category_medicine.category_id', 'categories.id'),
                'medicine_count'
            )
            ->withCount('medicines')
            ->orderBy('name')
            ->get();

        return view('categories', compact('categories'));
    }





    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return response()->json(['success' => 'Category added successfully!']);
    }

    public function show(Category $category)
    {
        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return response()->json(['success' => 'Category updated successfully!']);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['success' => 'Category deleted successfully!']);
    }

    public function getMedicines(Category $category)
    {
        return response()->json($category->medicines);
    }

    public function getAllMedicines()
    {
        $medicines = Medicine::all();
        return response()->json($medicines);
    }

    public function assignMedicines(Request $request, Category $category)
    {
        $validated = $request->validate([
            'medicines' => 'nullable|array',
            'medicines.*' => 'exists:medicines,id',
        ]);

        $medicineIds = $validated['medicines'] ?? [];
        $category->medicines()->sync($medicineIds);

        return response()->json(['success' => 'Medicines assigned successfully!']);
    }
}