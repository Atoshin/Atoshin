<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\wallet\storeWallet;
use App\Models\User;
use App\Models\Wallet;
use Exception;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function storeWallet(storeWallet $request)
    {
        $userWallet = $request->walletAddress;
        try {
            //check if this user has signed in before
            $wallet = Wallet::query()->where('wallet_address', $userWallet)->first();
            if ($wallet) {
                if ($wallet->user->signatures->where('type', 'login')->first()) {
                    return response()->json([
                        'message' => 'user already has wallet and signature',
                        'data' => true
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'user has no signature',
                        'data' => true
                    ], 409);
                }
            } else {
                //create a new user and attach the wallet to that user
                $user = User::query()->create([
                    'username' => $userWallet
                ]);
                Wallet::query()->create([
                    'wallet_address' => $userWallet,
                    'walletable_id' => $user->id,
                    'walletable_type' => User::class
                ]);
                return response()->json([
                    'message' => 'create new user and wallet successful',
                    'data' => true
                ], 201);
            }
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong',
                'data' => false
            ], 500);
        }
    }
}
