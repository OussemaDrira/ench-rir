<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Carbon\Carbon;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
    
            // Vérifier si l'utilisateur est actif ou si la suspension est déjà passée
            if ($user->active == 0 && $user->suspended_until && Carbon::now()->isBefore($user->suspended_until)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Votre compte est suspendu.',
                    'user'=>$user
                ], 403); // 403: Forbidden
            }
    
            // Générer le token et retourner la réponse réussie
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Connexion réussie',
                'token' => $token,
                'user' => $user,
                'role' => $user->role,
            ], 200);
        } else {
            // Identifiants invalides
            return response()->json([
                'status' => false,
                'message' => 'Identifiants invalides.',
            ], 401); // 401: Unauthorized
        }
    }
    
    
public function logout(Request $request)
{
$request->user()->tokens()->delete();
return response()->json([
'message' => 'Successfully logged out'
]);

}

public function Banner(Request $request,$idUser)
{
    $user = User::find($idUser);
    $user->active=0;
    $user->suspended_until=$request->input('suspended_until');
    $user->save();
    return response()->json($user, 201);
}
public function ListUser()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return $users;
    }








}