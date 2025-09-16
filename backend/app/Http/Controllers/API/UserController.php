<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){ return User::all(); }

    public function show($id){ return User::findOrFail($id); }

    public function update(Request $r,$id){
        $u = User::findOrFail($id);
        $u->update($r->only(['nom','prenom','service','fonction','role','email']));
        if($r->password) $u->update(['password'=>Hash::make($r->password)]);
        return response()->json($u);
    }

    public function destroy($id){ User::findOrFail($id)->delete(); return response()->json(['message'=>'deleted']); }
}
