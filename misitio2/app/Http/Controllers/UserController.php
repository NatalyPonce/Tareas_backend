<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
class UserController extends Controller
{

//El endpoint para buscar por parametros en la ruta
    public function index(Request $request)
    {
        $username = $request->query('username'); //parametro de username
        $email = $request->query('email'); //parametro de email
        $query = User::query(); //la query que se ingresa en la ruta
        if ($username) {
            $query->where('username', $username); //si se introdujo el username, se busca el que esté en 
        }
        if ($email) {
            //Like se usa para que podamos buscar por coincidencias en el email
            $query->where('email', 'LIKE', '%' . $email . '%');
        }
        $users = $query->get();
        return response()->json(UserResource::collection($users)); //lo devolvemos para mostrarlo y se envuelve en una colección, pues puede ser que no sea solo una coincidencia con el parametro en la ruta.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Str::random(8); // Le colocamos una contraseña por defecto

        $user = User::create($data);

        return response()->json(UserResource::make($user), 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(UserResource::make($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return response() -> json(UserResource::make($user));
    }

}
