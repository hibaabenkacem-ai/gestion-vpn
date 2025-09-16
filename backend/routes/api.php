<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{AuthController, UserController, DemandeVPNController, WorkflowValidationController, GroupeVPNController};

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout',[AuthController::class,'logout']);

    // users
    Route::apiResource('users', UserController::class)->except(['store']); // register via AuthController

    // groupes
    Route::apiResource('groupes', GroupeVPNController::class);
    Route::post('groupes/{id}/ajouter-user',[GroupeVPNController::class,'ajouterUtilisateur']);
    Route::post('groupes/{id}/supprimer-user',[GroupeVPNController::class,'supprimerUtilisateur']);

    // demandes
    Route::apiResource('demandes', DemandeVPNController::class);

    // workflow
    Route::apiResource('workflows', WorkflowValidationController::class);

    // add other routes as needed
});
