<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\PesanKonsultasiKonselor;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
// Otorisasi untuk channel private
Broadcast::channel('chat.{consultationId}', function ($user, $consultationId) {
    // $user di sini bisa jadi instance dari User atau Konselor
    $consultation = PesanKonsultasiKonselor::find($consultationId);
    if (!$consultation) {
        return false;
    }
    // Izinkan jika ID user cocok ATAU jika ID konselor cocok
    if ($user instanceof \App\Models\User) {
        return $user->id === $consultation->user_id;
    }
    if ($user instanceof \App\Models\Konselor) {
        return $user->id === $consultation->konselor_id;
    }
    return false;
});
