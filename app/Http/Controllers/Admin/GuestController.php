<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'per_page']);

        $query = User::query()->where('user_type_id', 5);

        // Search filter
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%");
            });
        }

        $perPage = $filters['per_page'] ?? 20;

        $guests = $query->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        $page_content = [
            'page_title'      => 'Guest List',
            'module_name'     => 'Guests',
            'module_route'    => route('admin.guests.index'),
            'sub_module_name' => 'All Guests',
        ];

        return view('backend.modules.student.guests.index', compact(
            'guests',
            'filters',
            'page_content'
        ));
    }

    public function qrCode($mobile)
    {
        // Your existing QR generation logic here.
        // Return a downloadable PNG or redirect to a QR generator view.
        return redirect()->route('admin.qrcode.student.show', ['mobile' => $mobile]);
    }
}
