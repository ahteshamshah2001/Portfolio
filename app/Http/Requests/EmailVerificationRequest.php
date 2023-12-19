<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Stripe\Customer;
use Stripe\Stripe;

class EmailVerificationRequest extends \Illuminate\Foundation\Auth\EmailVerificationRequest
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function authorize()
    {
        $user = User::findOrFail($this->route('id'));
        if (!hash_equals((string)$this->route('hash'),
            sha1($user->getEmailForVerification()))) {
            return false;
        }

        return true;
    }

    public function fulfill()
    {
        $user = User::findOrFail($this->route('id'));
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            try {
                $customer = Customer::create([
                    'name' => $user->first_name . " " . $user->last_name,
                    'email' => $user->email,
                ]);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
            User::findOrFail($this->route('id'))->update(
                ['stripe_customer_id' => $customer->id, 'status' => 1]
            );
            $user = User::findOrFail($this->route('id'));
            event(new Verified($user));
            echo "Account Is Verified Now";
            die;
        }
    }
}
