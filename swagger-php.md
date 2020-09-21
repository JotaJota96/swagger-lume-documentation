# Swagger en lumen/laravel

Generacion de documentacion Swagger a partir de anotaciones en los comentarios del código PHP.

Ver el repositorio de la heramienta utilizada en <https://github.com/DarkaOnLine/SwaggerLume>

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
         *   title="Example API",
         *   version="1.0",
         *   @OA\Contact(
         *     email="support@example.com",
         *     name="Support Team"
         *   )
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
