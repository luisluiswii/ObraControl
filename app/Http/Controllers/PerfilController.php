<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = auth()->user();

        $documentos = Documento::query()
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(8);

        return view('perfil', compact('user', 'documentos'));
    }

    public function updatePhoto(Request $request)
    {
        $data = $request->validate([
            'foto_perfil' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ]);

        $user = $request->user();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $path = $request->file('foto_perfil')->store('profile-photos/' . $user->id, 'public');
        $user->profile_photo_path = $path;
        $user->save();

        return redirect()->route('perfil')->with('success', 'Foto de perfil actualizada.');
    }

    public function password()
    {
        $user = auth()->user();

        return view('perfil_password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->user();

        $user->password = Hash::make($data['password']);
        $user->must_change_password = false;
        $user->save();

        return redirect()->route('perfil')->with('success', 'Contraseña actualizada correctamente.');
    }
}
