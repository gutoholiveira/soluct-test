<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ApiController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private ApiService $api_service) {}

    /**
     * Return the API status
     *
     * @return JsonResponse
     */

    /**
     * @OA\Get(
     *     path="/status",
     *     summary="Get API Status",
     *     description="Retrieves the current status of the API, including database connection, last cron execution time, system uptime, and memory usage.",
     *     tags={"Status"},
     *     @OA\Response(
     *         response=200,
     *         description="API status details retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="api_details",
     *                 type="object",
     *                 @OA\Property(
     *                     property="database_connection",
     *                     type="object",
     *                     @OA\Property(
     *                         property="read",
     *                         type="boolean",
     *                         example=true,
     *                         description="Status of read connection to the database"
     *                     ),
     *                     @OA\Property(
     *                         property="write",
     *                         type="boolean",
     *                         example=true,
     *                         description="Status of write connection to the database"
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="last_cron_execution",
     *                     type="string",
     *                     example="2024-11-08 12:00:00",
     *                     description="Timestamp of the last cron job execution or a message indicating it hasn't run recently"
     *                 ),
     *                 @OA\Property(
     *                     property="uptime",
     *                     type="string",
     *                     example="3 days, 4 hours, 15 minutes",
     *                     description="The system uptime in a human-readable format"
     *                 ),
     *                 @OA\Property(
     *                     property="memory_usage",
     *                     type="string",
     *                     example="100 MB",
     *                     description="Current memory usage of the system"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="An error occurred while retrieving the status",
     *                 description="Error message indicating a problem occurred"
     *             )
     *         )
     *     )
     * )
     */
    public function getStatus(): JsonResponse
    {
        $data = $this->api_service->getStatus();

        return response()->json(['message' => 'success', 'data' => $data], Response::HTTP_OK);
    }
}
