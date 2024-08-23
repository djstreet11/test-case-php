<?php

namespace App\Http\Requests;

use App\Enums\Delivery;
use Illuminate\Foundation\Http\FormRequest;

class DeliverySendRequest extends FormRequest
{

    public function rules()
    {
        $apiType = $this->apiType();

        $rules = [
            'api_slug' => 'required|string|in:' . implode(',', Delivery::allSlugs()),

            //list of base fields for all delivery services
            'customer_name' => '',
            'phone_number' => '',
            'email' => '',
        ];

        // list for specific fields for each delivery service
        switch ($apiType) {
            case Delivery::NOVA_POSHTA:
                $rules['office_number'] = '';
                break;

            case Delivery::UKR_POSHTA:
                $rules['post_index'] = '';
                break;

            case Delivery::JUSTIN:
                $rules['reference_number'] = '';
                break;

            default:
                break;
        }

        return $rules;
    }

    //get variant of delivery service slug for use in rules for specific fields
    public function apiType(): Delivery
    {
        $slug = $this->input('api_slug');
        $apiType = Delivery::fromSlug($slug);

        if (!$apiType) {
            throw new \Exception("Invalid API slug: $slug");
        }

        return $apiType;
    }
}
