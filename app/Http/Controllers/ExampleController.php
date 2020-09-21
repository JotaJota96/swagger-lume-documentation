<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/usuarios/",
     *     tags={"Usuarios"},
     *     security={{"api_key": {}}},
     *
     *     @OA\Response(
     *         response="200",
     *         description="Devuelve un usuario correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/UsuarioDTO"),
     *     ),
     * )
     */
    public function obtenerTodo(){
        // ...
    }

     /**
     * @OA\Get(
     *     path="/usuarios/{id}",
     *     tags={"Usuarios"},
     *     security={{"api_key": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del usuario",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuario encontrado y devuelto",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/UsuarioDTO"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No existe nada con ese ID",
     *     ),
     * )
     */
    public function obtenerUno(integer $id){
        // ...
    }

     /**
     * @OA\Post(
     *     path="/usuarios/",
     *     tags={"Usuarios"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/UsuarioDTO"),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Usuario creado y devuelto",
     *         @OA\JsonContent(ref="#/components/schemas/UsuarioDTO"),
     *     ),
     * )
     */
    public function crear(Request $request){
        // ...
    }

     /**
     * @OA\Put(
     *     path="/usuarios/{id}",
     *     tags={"Usuarios"},
     *     security={{"api_key": {}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/UsuarioDTO"),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Usuario actualizado y devuelto",
     *         @OA\JsonContent(ref="#/components/schemas/UsuarioDTO"),
     *     ),
     * )
     */
    public function actualizar(Request $request, integer $id){
        // ...
    }

     /**
     * @OA\Delete(
     *     path="/usuarios/{id}",
     *     tags={"Usuarios"},
     *     security={{"api_key": {}}},
     *     @OA\Response(
     *         response="200",
     *         description="Usuario eliminado y devuelto",
     *         @OA\JsonContent(ref="#/components/schemas/UsuarioDTO"),
     *     ),
     * )
     */
    public function eliminar(integer $id){
        // ...
    }

}
