<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="API Documentation",
 *     version="1.0.0",
 *     description="This is the API documentation for the carpooling application."
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 * 
 */
class ApiDocController extends Controller
{
    // Ce contrôleur peut rester vide
}
