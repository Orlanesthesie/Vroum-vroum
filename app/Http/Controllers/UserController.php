<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmed;
use App\Mail\ReservationCancelled;


/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     description="User model",
 *     required={"lastname", "firstname", "email", "password"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID of the user",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="lastname",
 *         type="string",
 *         description="Last name of the user",
 *         example="Doe"
 *     ),
 *     @OA\Property(
 *         property="firstname",
 *         type="string",
 *         description="First name of the user",
 *         example="John"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="Email address of the user",
 *         example="john.doe@example.com"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         format="password",
 *         description="Password of the user",
 *         example="password123"
 *     ),
 *     @OA\Property(
 *         property="avatar",
 *         type="string",
 *         description="Avatar image URL of the user",
 *         example="avatars/johndoe.png"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Creation timestamp",
 *         example="2024-07-01T12:00:00Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Last update timestamp",
 *         example="2024-07-15T12:00:00Z"
 *     )
 * )
 */


class UserController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Create a new user",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="lastname", type="string", example="Doe"),
     *             @OA\Property(property="firstname", type="string", example="John"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="avatar", type="file", description="Avatar image")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */

    public function store(Request $request)
    {
        $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath ?? null,
        ]);

        return response()->json($user, 201);
    }


    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get all users",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="Get user by ID",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of user to return",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        // $this->authorize('view', $user);

        return response()->json($user);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Update user",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of user to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="lastname", type="string", example="Doe"),
     *             @OA\Property(property="firstname", type="string", example="John"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="avatar", type="file", description="Avatar image")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {

        $currentUser = Auth::user();
        $user = User::findOrFail($id);
        // $user = User::findOrFail($id);
        // $this->authorize('update', $user);

        $request->validate([
            'lastname' => 'string|max:255|nullable',
            'firstname' => 'string|max:255|nullable',
            'email' => 'string|email|max:255|nullable|unique:users,email,' . $id,
            'password' => 'string|min:8|nullable',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update($request->except(['password', 'avatar']));

        return response()->json($user);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Delete user",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of user to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // $this->authorize('delete', $user);

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    /**
     * @OA\Post(
     *     path="/api/reservation",
     *     summary="Reserve a trip",
     *     tags={"Reservations"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="trip_id", type="integer", example=1, description="ID of the trip to reserve")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Trip reserved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Trip reserved successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="No available places for this trip")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthorized")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="You have already reserved this trip")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Trip not found")
     *         )
     *     )
     * )
     */

     public function reservation(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $validatedData = $request->validate([
            'trip_id' => 'required|exists:trips,id',
        ]);

        $tripId = $validatedData['trip_id'];

        $trips = json_decode($user->trip_id, true) ?? [];

        if (in_array($tripId, $trips)) {
            return response()->json(['error' => 'You have already reserved this trip'], 400);
        }

        $trip = Trip::find($tripId);
        if ($trip->available_places <= 0) {
            return response()->json(['error' => 'No available places for this trip'], 400);
        }

        $trips[] = $tripId;
        $user->trip_id = json_encode($trips);
        $user->save();

        $trip->decrement('available_places');

        Mail::to($user->email)->send(new ReservationConfirmed($trip));

        return response()->json(['message' => 'Trip reserved successfully'], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/cancel-reservation",
     *     summary="Cancel a trip reservation",
     *     tags={"Reservations"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="trip_id",
     *                 type="integer",
     *                 description="ID of the trip to cancel",
     *                 example=1
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Trip cancelled successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Trip cancelled successfully"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="You have not reserved this trip",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="string",
     *                 example="You have not reserved this trip"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="User not authenticated",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="string",
     *                 example="User not authenticated"
     *             )
     *         )
     *     )
     * )
     */
    public function cancel(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $validatedData = $request->validate([
            'trip_id' => 'required|exists:trips,id',
        ]);

        $tripId = $validatedData['trip_id'];

        // Récupérer les réservations de l'utilisateur
        $trips = json_decode($user->trip_id, true) ?? [];

        // Vérifiez si l'utilisateur a réservé ce trajet
        if (!in_array($tripId, $trips)) {
            return response()->json(['error' => 'You have not reserved this trip'], 400);
        }

        // Retirer le trip_id du tableau des réservations de l'utilisateur
        $trips = array_filter($trips, fn ($id) => $id != $tripId);
        $user->trip_id = json_encode($trips);
        $user->save();

        // Augmenter le nombre de places disponibles pour le trajet annulé
        $trip = Trip::find($tripId);
        $trip->increment('available_places');

        // // Envoyer un email de confirmation d'annulation
        Mail::to($user->email)->send(new ReservationCancelled($trip));

        return response()->json(['message' => 'Trip cancelled successfully'], 200);
    }


}
