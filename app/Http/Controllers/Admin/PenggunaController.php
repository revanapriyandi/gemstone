<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        return view('admin.pengguna.index', [
            'title' => 'Pengguna',
            'subtitle' => 'Daftar Pengguna'
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->status = 0;
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil dihapus'
        ]);
    }

    public function show($id)
    {
        $user = User::with('transaksi')->findOrFail($id);

        return view('admin.pengguna.show', [
            'title' => $user->name,
            'subtitle' => 'Detail Pengguna',
            'user' => $user
        ]);
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:0,1,2'
        ]);
        $user = User::findOrFail($id);
        $user->status =  $request->status;
        $user->update();

        return redirect()->back()->with('success', 'Status pengguna berhasil diubah');
    }

    public function fetchPengguna(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->getDataForDataTable($request->filter);

            return $data;
        }

        return abort(404);
    }

    private function getDataForDataTable($filter)
    {
        $query = User::where('role', 'user')
            ->whereNull('deleted_at');

        if ($filter == '1') {
            $query->where('status', 1);
        } elseif ($filter == '0') {
            $query->where('status', 0);
        } elseif ($filter == '2') {
            $query->where('status', 2);
        } elseif ($filter == 'deleted') {
            $query->whereNotNull('deleted_at');
        }

        $users = $query->get();

        return datatables()->of($users)
            ->addIndexColumn()
            ->addColumn('actions', function ($data) {
                return '<a href="' . route('pengguna.show', $data->id) . '" class="btn btn-link text-primary" data-bs-toggle="tooltip" title="Show user data"><span class="fa fa-eye"></span></a>
            <button id="deleteBtn" class="btn btn-link text-danger" data-bs-toggle="tooltip" title="Delete User" data-id="' . $data->id . '"><span class="fa fa-trash"></span></button>';
            })
            ->addColumn('status', function ($data) {
                $status = $data->status ? 'Aktif' : 'Tidak Aktif';
                $class = $data->status ? 'success' : 'danger';
                return '<a href="javascript:" data-id="' . $data->id . '" id="updateStatus" class="badge bg-gradient-' . $class . '">' . $status . '</a>';
            })
            ->addColumn('profile', function ($data) {
                return ' <img class="img-fluid rounded-3 w-50" src="' . $data->profile_photo_url . '" alt="' . $data->name . ' Logo">';
            })
            ->addColumn('name', function ($data) {
                return '<a href="' . route('pengguna.show', $data->id) . '">' . ucwords($data->name) . '</a>';
            })

            ->addColumn('email', function ($data) {
                return '<a href="mailto:' . $data->email . '" target="_blank" class="text-decoration-none">' . $data->email . '</a>';
            })

            ->addColumn('phone', function ($data) {
                $phone = $data->phone ? $data->phone : '-';
                return '<a href="tel:' . $data->phone . '" target="_blank" class="text-decoration-none">' . $phone . '</a>';
            })

            ->editColumn('created_at', function ($type) {
                return $type->created_at->format('d M Y H:i');
            })
            ->rawColumns(['actions', 'status', 'name', 'email', 'phone', 'profile'])
            ->toJson();
    }
}
