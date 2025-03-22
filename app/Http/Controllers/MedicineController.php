<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MedicineController extends Controller
{
    /**
     * Get expired or expiring medicines based on filter
     */
    public function expiredMedicines(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $today = Carbon::today();
        
        $query = Medicine::query();
        
        switch ($filter) {
            case 'expired':
                $query->where('expiry_date', '<', $today);
                break;
            case 'expiring':
                $query->whereBetween('expiry_date', [$today, $today->copy()->addDays(30)]);
                break;
            case 'expiring90':
                $query->whereBetween('expiry_date', [$today, $today->copy()->addDays(90)]);
                break;
            case 'all':
            default:
                // For "all", we'll show both expired and those expiring within 90 days
                $query->where('expiry_date', '<', $today->copy()->addDays(90));
                break;
        }
        
        $medicines = $query->orderBy('expiry_date')->get();
        
        return response()->json($medicines);
    }

    /**
     * Get count of medicines
     */
    public function count()
    {
        $count = Medicine::count();
        return response()->json(['count' => $count]);
    }

    /**
     * Get medicines that are expiring within 30 days
     */
    public function getExpiringMedicines()
    {
        $expiringMedicines = Medicine::where('expiry_date', '>=', Carbon::now())
            ->where('expiry_date', '<=', Carbon::now()->addDays(30))
            ->orderBy('expiry_date')
            ->take(5)
            ->get(['name', 'quantity', 'expiry_date']);
        
        return response()->json(['medicines' => $expiringMedicines]);
    }

    /**
     * Get medicines with low stock (less than 10 units)
     */
    public function getLowStockMedicines()
    {
        $lowStockMedicines = Medicine::where('quantity', '<', 10)
            ->orderBy('quantity')
            ->take(5)
            ->get(['name', 'quantity', 'price']);
        
        return response()->json(['medicines' => $lowStockMedicines]);
    }

    /**
     * Get expired medicines
     */
    public function expiredMedicinesList()
    {
        $expiredMedicines = Medicine::where('expiry_date', '<', Carbon::now())
            ->orderBy('expiry_date', 'desc')
            ->get();
        
        return response()->json(['medicines' => $expiredMedicines]);
    }

    public function index()
    {
        $medicines = Medicine::all();
        return view('inventory', compact('medicines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'expiry_date' => 'required|date',
            'manufacturer' => 'nullable|string|max:255',
        ]);

        Medicine::create($validated);

        return response()->json(['success' => 'Medicine added successfully!']);
    }

    public function show(Medicine $medicine)
    {
        return response()->json($medicine);
    }

    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'expiry_date' => 'required|date',
            'manufacturer' => 'nullable|string|max:255',
        ]);

        $medicine->update($validated);

        return response()->json(['success' => 'Medicine updated successfully!']);
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return response()->json(['success' => 'Medicine deleted successfully!']);
    }
}
