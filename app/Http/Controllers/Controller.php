<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *   title="Ejemplo de documentacion API",
     *   description="Este es un ejemplo de documentacion de una API hecha en Lumen/Laravel",
     *   version="1.0",
     *   @OA\Contact(
     *     email="correo@gmail.com",
     *     name="Juan Alvarez"
     *   )
     * )
     */
   //--------------------------------------------------------
    /**
    * @OA\SecurityScheme(
    *     securityScheme="api_key",
    *     type="apiKey",
    *     in="header",
    *     name="Authorization",
    *     description="Token de autenticacion conformato como '<token>'",
    * )
    */
   //--------------------------------------------------------
    /**
     * @OA\Schema(
     *   schema="UsuarioDTO",
     *   @OA\Property(property="id",     type="number"),
     *   @OA\Property(property="nombre", type="string"),
     *   @OA\Property(property="edad",   type="integer"),
     *   @OA\Property(property="sexo", type="string", description="Puede ser M o F"),
     *   @OA\Property(property="activo", type="boolean"),
     * )
     */
   //--------------------------------------------------------
    /**
     * @OA\Schema(
     *   schema="PublicacionDTP",
     *   @OA\Property(property="id",     type="number"),
     *   @OA\Property(property="texto",  type="string"),
     *   @OA\Property(
     *     property="usuario",
     *     ref="#/components/schemas/UsuarioDTO",
     *   ),
     *   @OA\Property(
     *     property="categoria",
     *      type="object",
     *      @OA\Property(property="id",        type="number"),
     *      @OA\Property(property="nombreCat", type="string"),
     *   ),
     *   @OA\Property(
     *     property="comentarios",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/ComentarioDTO"),
     *   ),
     *   @OA\Property(
     *     property="tags",
     *     type="array",
     *     @OA\Items(
     *        @OA\Property(property="id",        type="number"),
     *        @OA\Property(property="nombreTag", type="string"),
     *     ),
     *   ),
     * )
     */
   //--------------------------------------------------------
    /**
     * @OA\Schema(
     *   schema="ComentarioDTO",
     *   @OA\Property(property="id",     type="number"),
     *   @OA\Property(property="texto",  type="string"),
     *   @OA\Property(
     *     property="usuario",
     *     ref="#/components/schemas/UsuarioDTO",
     *   ),
     * )
     */

}
