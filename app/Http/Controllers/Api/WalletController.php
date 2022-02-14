<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\wallet\storeWallet;
use App\Models\Signature;
use App\Models\User;
use App\Models\Wallet;
use Exception;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function storeWallet(storeWallet $request)
    {
        $userWallet = $request->walletAddress;
        try {
            //check if this user has signed in before
            $wallet = Wallet::query()->where('wallet_address', $userWallet)->first();
            if ($wallet) {
                //check if user has signature
                $user = User::query()->find($wallet->walletable_id);
                if ($user->signatures->where('type', 'login')->first()) {
                    return response()->json([
                        'message' => 'user already has wallet and signature',
                        'data' => true
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'user has no signature',
                        'data' => false
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
                    'data' => false
                ], 201);
            }
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong',
                'data' => true
            ], 500);
        }
    }

    public function storeSignature(Request $request)
    {
        $request->validate([
            'signature' => 'required|string|regex:/0x[a-fA-F0-9]{130}/',
            'walletAddress' => 'required|string|regex:/0x[a-fA-F0-9]{40}/'
        ]);

        try {
            $wallet = Wallet::query()->where('wallet_address', $request->walletAddress)->first();
            $user = User::query()->find($wallet->walletable_id);
            Signature::query()->create([
                'type' => 'login',
                'hash' => $request->signature,
                'user_id' => $user->id
            ]);

            return response()->json([
                'message' => 'stored signature',
                'data' => true
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong',
                'data' => false
            ], 500);
        }
    }
}
