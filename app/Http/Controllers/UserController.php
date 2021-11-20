<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index() {
        return Inertia::render('User/Index', [
            'users' => User::with(['roles' => fn($q) => $q->select('name')])->withCount('customers_appraised', 'customers')->latest('id')->paginate(10),
        ]);
    }

    public function update(Request $request, User $user) {
        if ($user->hasRole('admin')) {
            return response('Không thể hạ quyền Admin!', 403);
        }
        $validated = $request->validate([
            'role' => 'required|in:saler,appraiser,disburser,member'
        ]);
        $user->syncRoles($validated['role']);
        return response('Cập nhật quyền thành công!', 200);
    }

    public function destroy(User $user) {
        if ($user->hasRole('admin')) {
            return response('Không thể xóa thành viên có chức vụ Admin!', 403);
        }
        $user->delete();
        return response()->noContent();
    }
}
