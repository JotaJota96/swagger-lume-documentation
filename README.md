# Swagger en lumen/laravel

Generacion de documentacion Swagger a partir de anotaciones en los comentarios del código PHP.

Ver el repositorio de la heramienta utilizada en <https://github.com/DarkaOnLine/SwaggerLume>

Luego de leer esta documentacion, en el archivo `App/Http/Controllers/ExampleController.php` hay un ejemplo completo de un CRUD simple.

## Instalación

Ejecutar todos los comandos parados en la raiz del proyecto

1. Agregar la dependencia al proyecto

    ```bash
    composer require "darkaonline/swagger-lume:7.*"
    ```

2. Editar el archivo `bootstrap/app.php`

    2.1. Descomentar la linea:

    ```php
    $app->withFacades();
    ```

    2.2. Al final de la seccion **Create The Application**, agregar lo siguiente:

    ```php
    $app->configure('swagger-lume');
    ```

    2.3. En la secion Register Service Providers, agregar:

    ```php
    $app->register(\SwaggerLume\ServiceProvider::class);
    ```

3. Publicar el archivo de configuración para **swagger-lume**

    ```bsh
    php artisan swagger-lume:publish
    ```

4. Agregar anotaciones al código de la API

    4.1. Agregar información general de la API en el archivo `App/Http/Controllers/Controller.php`

    ```php
        /**
        * @OA\Info(
        *     title="Example API",
        *     version="1.0",
        *     @OA\Contact(
        *         email="support@example.com",
        *         name="Support Team"
        *     )
        * )
        */
    ```

    4.2. Agregar información sobre al menos un recurso de la API. Para probar se puede agregarlo siguiente en el archivo `App/Http/Controllers/ExampleController.php`.

    ```php
        /**
         * @OA\Get(
         *     path="/sample/{category}/things",
         *     operationId="/sample/category/things",
         *     tags={"yourtag"},
         *     @OA\Parameter(
         *         name="category",
         *         in="path",
         *         description="The category parameter in path",
         *         required=true,
         *         @OA\Schema(type="string")
         *     ),
         *     @OA\Parameter(
         *         name="criteria",
         *         in="query",
         *         description="Some optional other parameter",
         *         required=false,
         *         @OA\Schema(type="string")
         *     ),
         *     @OA\Response(
         *         response="200",
         *         description="Returns some sample category things",
         *         @OA\JsonContent()
         *     ),
         *     @OA\Response(
         *         response="400",
         *         description="Error: Bad request. When required parameters were not supplied.",
         *     ),
         * )
         */
    ```

5. Generar la documentacion Swagger. (Ejecutar el comando cada vez que se actualize algo en las anotaciones)

    ```bash
    php artisan swagger-lume:generate
    ```

6. Poner a correr el servidor **artisan**

    ```bash
    php -S localhost:8000 -t public/
    ```

7. Para ver la documentacion:

    - **JSON:** <http://localhost:8000/docs>
    - **Swagger UI:** <http://localhost:8000/api/documentation>

8. Si la **Swagger UI** no se ve, ejecutar los comandos y luego recargar la página:

    ```bash
    mkdir public/swagger-ui-assets
    cp vendor/swagger-api/swagger-ui/dist/* public/swagger-ui-assets
    ```

Instrucciones basadas en: <https://stackoverflow.com/questions/45211512/how-to-integrate-swagger-in-lumen-laravel-for-rest-api>

## Notacion

### Informacion general de la API

Es recomendable colocarla en el archivo `App/Http/Controllers/Controller.php`

```php
    /**
     * @OA\Info(
     *     title="Example API",
     *     version="1.0",
     *     @OA\Contact(
     *         email="support@example.com",
     *         name="Support Team"
     *     )
     * )
     */
```

### Esquemas

Un esquema es la definicion de una estructura la cual puede ser referenciada desde otras anotaciones. (Para no repetir código)

### Esquema de seguridad basico (token)

Define un esquema que agregará un **header** a cada peticion.

Es recomendable colocarla en el archivo `App/Http/Controllers/Controller.php`

```php
    /**
     * @OA\SecurityScheme(
     *     securityScheme="api_key",
     *     type="apiKey",
     *     in="header",
     *     name="Authorization",
     *     description="Token de autenticacion conformato como '<token>'",
     * )
     */
```

- **securityScheme:** Nombre con el que se le hará referencia
- **name:** Nombre del header que se agregará

### Esquemas de objetos

#### Esquemas de objeto simple

```php
    /**
     * @OA\Schema(
     *     schema="UsuarioDTO",
     *     @OA\Property(property="id",     type="number"),
     *     @OA\Property(property="nombre", type="string"),
     *     @OA\Property(property="edad",   type="integer"),
     *     @OA\Property(property="sexo",   type="string", description="Puede ser M o F"),
     *     @OA\Property(property="activo", type="boolean"),
     * )
     */
```

- **type:** Puede ser: `string` (incluye fechas y archivos), `number`, `integer`, `boolean`, `array`, `object`

#### Esquemas de objeto complejo

Dentro de un esquema de objeto se pueden definir o referenciar otros objetos, de manera directa o dentro de arrays.

- Definir el objeto dentro del objeto

    ```php
        *     @OA\Property(
        *         property="categoria",
        *         type="object",
        *         @OA\Property(property="id",        type="number"),
        *         @OA\Property(property="nombreCat", type="string"),
        *     ),
    ```

- Referenciar a un esquema definido anteriormente

    ```php
        *     @OA\Property(
        *         property="usuario",
        *         ref="#/components/schemas/UsuarioDTO",
        *     ),
    ```

- Array definiendo el objeto

    ```php
        *     @OA\Property(
        *         property="tags",
        *         type="array",
        *         @OA\Items(
        *             @OA\Property(property="id",        type="number"),
        *             @OA\Property(property="nombreTag", type="string"),
        *         ),
        *     ),
    ```

- Array referenciando a un esquema definido anteriormente

    ```php
        *     @OA\Property(
        *         property="comentarios",
        *         type="array",
        *         @OA\Items(ref="#/components/schemas/ComentarioDTO"),
        *     ),
    ```

### Recursos expuestos

Todo recurso que la API exponga debe tener el siguiente formato

```php
    /**
     * @OA\Get(
     *     path="/usuarios/",
     *     tags={"Usuarios"},
     *
     *  .. otros detalles...
     *
     *     @OA\Response(
     *         response="default",
     *         description=""
     *     ),
     * )
     */
```

La primera linea puede ser: `@OA\Get`, `@OA\Post`, `@OA\Put`, `@OA\Delete`

Si la ruta está protegida (requiere enviar token), se puede referenciar al esquema creado anteriormente:

```php
     *     security={{"api_key": {}}},
```

Si la ruta incluye parámetros, se lo debe describir: (ino por uno)

```php
    /**
     * @OA\Get(
     *     path="/usuarios/{id}",
     *     tags={"Usuarios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del usuario",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *
     *  .. otros detalles...
     * )
     */
```

Si el cuerpo de la peticion debe incluir un JSON, se puede referenciar un esquema o definirlo:

```php
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/UsuarioDTO"),
     *     ),
```

```php
    *     @OA\RequestBody(
    *         @OA\JsonContent(
    *             OA\Property(property="id",         type="number"),
    *             @OA\Property(property="nombreCat", type="string"),
    *         ),
    *     ),
```

Por ultimo se debe especificar al menos una respuesta. Se puede retornar un objeto o un array de objetos:

```php
     *     @OA\Response(
     *         response="200",
     *         description="Devuelve un usuario correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/UsuarioDTO"),
     *     ),
```

```php
     *     @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/UsuarioDTO"),
     *         ),
     *     ),
```
