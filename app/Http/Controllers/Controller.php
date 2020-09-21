<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
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


    Home
        Public

    Stack Overflow
    Tags
    Users
    Find a Job
    Jobs
    Companies

    Teams
    What’s this?

        Free 30 Day Trial

How to integrate Swagger in Lumen/Laravel for REST API?
Ask Question
Asked 3 years, 2 months ago
Active 3 months ago
Viewed 11k times
9

I have built some REST API in Lumen micro framework and it's working fine. Now I want to integrate Swagger into it so the API will be well documented on future use. Has anyone done this?
laravel-5.4 lumen
share improve this question
edited Jun 9 '18 at 20:59
halfer
18.1k1010 gold badges7272 silver badges145145 bronze badges
asked Jul 20 '17 at 10:02
Anand Pandey
1,77733 gold badges1111 silver badges3636 bronze badges

    This might be of interest: github.com/DarkaOnLine/SwaggerLume – The Unknown Dev Sep 6 '17 at 21:07
    @KimberlyW: i have integrate this but how to use it? – Anand Pandey Sep 12 '17 at 7:10
    You need to add swagger comments as shown in the link below and follow the documentation from SwaggerLume for generating the actual Swagger HTML pages. github.com/zircote/swagger-php – The Unknown Dev Sep 12 '17 at 22:57
    @AnandPandey I listed all endpoints created by Lumen and found Swagger UI webpage on /api/documentation path and the Swagger json on /docs path. I didn't find anything in the docs though. – Peter Badida Mar 8 at 16:50 

    This article is helpful for every beginner phparticles.com/laravel/… – Mr.Happy Jul 20 at 11:58

add a comment
2 Answers
Active
Oldest
Votes
12

Steps to follow for Laravel Lumen 5.7 with swagger using OpenApi 3.0 specs (this governs the way you write annotations so that swagger documentation is generated)

I reached this adjusting on @black-mamba answer in order to make it work.

1. Install swagger-lume dependency (which also installs swagger)

composer require "darkaonline/swagger-lume:5.6.*"

2. Edit bootstrap/app.php file

    make sure $app->withFacades(); is NOT commented (around line 26)

    in Create The Application section add the following before Register Container Bindings section

    $app->configure('swagger-lume');

    in Register Service Providers section add

    $app->register(\SwaggerLume\ServiceProvider::class);

3. Publish configuration file for swagger-lume

php artisan swagger-lume:publish

4. Add annotations to your code

For example in your app/Http/Controllers/Controller.php you could have the general part of the documentation

<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
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
}
