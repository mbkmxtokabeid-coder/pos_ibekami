<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
  public function index()
  {
    $users = User::orderByDesc('created_at')->get();
    return view('pages.user.daftar-user', compact('users'));
  }

  public function addUser()
  {
    return view('pages.user.addUser');
  }

  public function storeUser(Request $request)
  {
    $request->validate([
      'namaKaryawan' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email',
      'password' => 'required|string|min:5',
      'role' => 'required|string',
    ]);

    if ($request->re_password != $request->password) {
      Alert::error('Password tidak sama');
      return redirect()->back()->withInput();
    }

    User::create([
      'nama' => $request->namaKaryawan,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'nomor_telepon' => $request->no_telp,
      'role' => $request->role,
      'status' => 'Aktif',
    ]);

    Alert::success('User Berhasil ditambahkan');
    return redirect()->route('user.index');
  }

  public function status($id)
  {
    $user = User::find($id);
    if (!$user) {
      Alert::error('User tidak ditemukan');
      return redirect()->back();
    }

    // Cegah self-deactivation yang dapat mengunci akun sendiri
    if ($user->id == Auth::id() && $user->status === 'Aktif') {
      Alert::error('Gagal', 'Anda tidak dapat menonaktifkan akun yang sedang digunakan.');
      return redirect()->back();
    }

    if ($user->status == 'Aktif') {
      $user->status = 'Non Aktif';
      $user->save();
      Alert::success('User Di Non-Aktifkan');
    } else {
      $user->status = 'Aktif';
      $user->save();
      Alert::success('User Di Aktifkan');
    }

    return redirect()->route('user.index');
  }

  public function edit($id)
  {
    $user = User::find($id);
    if (!$user) {
      Alert::error('User tidak ditemukan');
      return redirect()->route('user.index');
    }
    $roles = ['Admin', 'Produksi', 'Pemilik', 'Stockist', 'Magang', 'AdminTKB'];
    return view('pages.user.edit-user', compact('user', 'roles'));
  }

  public function update(Request $request, $id)
  {
    $user = User::find($id);
    if (!$user) {
      Alert::error('User tidak ditemukan');
      return redirect()->route('user.index');
    }

    $request->validate([
      'namaKaryawan' => 'required|string|max:255',
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
      'role' => 'required|string',
    ]);

    $data = [
      'nama' => $request->namaKaryawan,
      'email' => $request->email,
      'nomor_telepon' => $request->no_telp,
      'role' => $request->role,
    ];

    // Hanya update password jika diisi
    if ($request->filled('password')) {
      if ($request->re_password !== $request->password) {
        Alert::error('Password tidak sama');
        return redirect()->back()->withInput();
      }
      if (strlen($request->password) < 5) {
        Alert::error('Password minimal 5 karakter');
        return redirect()->back()->withInput();
      }
      $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    Alert::success('User Berhasil diubah');
    return redirect('daftar-user');
  }

  public function profiles()
  {
    return view('pages.user.profile');
  }

  public function updateProfile(Request $request, $id)
  {
    // IDOR Protection: Pengguna hanya boleh mengubah profil miliknya sendiri, kecuali jika memiliki role Pemilik
    if (Auth::id() != $id && Auth::user()->role !== 'Pemilik') {
      abort(403, 'Anda tidak memiliki hak untuk mengubah profil pengguna lain.');
    }

    $user = User::find($id);
    if (!$user) {
      Alert::error('User tidak ditemukan');
      return redirect()->back();
    }

    $request->validate([
      'namaKaryawan' => 'required|string|max:255',
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
    ]);

    $data = [
      'nama' => $request->namaKaryawan,
      'email' => $request->email,
      'nomor_telepon' => $request->no_telp,
    ];

    // Hanya update password bila field password diisi oleh pengguna
    if ($request->filled('password')) {
      if (strlen($request->password) < 5) {
        Alert::error('Password minimal 5 karakter');
        return redirect()->back()->withInput();
      }
      $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    Alert::success('Profile berhasil di update');
    if ($user->role === 'Pemilik' || $user->role === 'Admin') {
      return redirect('/');
    } elseif ($user->role === 'Produksi') {
      return redirect('/daftar-spk');
    } else {
      return redirect('/stok-tinta');
    }
  }
}
