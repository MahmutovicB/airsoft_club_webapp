<?php

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="Airsoft Club API",
 *         description="Airsoft Club WebApp API",
 *         version="1.0",
 *         @OA\Contact(
 *             email="bm.mahmutovic@gmail.com",
 *             name="Benjamin Mahmutovic"
 *         )
 *     ),
 *     @OA\Server(
 *         url="http://localhost:8888/airsoftV2/backend",
 *         description="API server"
 *     )
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="ApiKey",
 *     type="apiKey",
 *     in="header",
 *     name="Authentication"
 * )
 */