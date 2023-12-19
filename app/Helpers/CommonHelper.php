<?php

// Attribute for select drop down
use Illuminate\Support\Str;

function matchSelected($param1, $param2)
{
    return $param1 == $param2 ? ' selected="selected" ' : '';
}

// Attribute for checkbox and radio button
function matchChecked($param1, $param2)
{
    return $param1 == $param2 ? ' checked="checked" ' : '';
}

function validateError($validator)
{
    return [
        'statusCode' => 400,
        'response' => [
            'data' => []
        ],
        'message' => 'Bad Request!',
        'status' => false,
        'errors' => $validator['message']->messages(),
    ];
}

function dateForMysql($date = '')
{
    $date = str_replace(['/', '.', ' '], '-', $date);
    return $date != '' ? date('Y-m-d', strtotime($date)) : '0000-00-00';
}

function customizeNotification($notification = [])
{
    $notificationArray['notificationId'] = $notification['id'];

    foreach ($notification['data'] as $responseData) {
        foreach ($responseData as $key => $data) {
            switch ($key) {
                case 'bid':
                    switch ($responseData['event']) {
                        case 'bid_created':
                            $notificationArray['bid'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = $data['job']['id'];
                            $notificationArray['jobTitle'] = $data['job']['title'];
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.job_details_url') . '/' . $data['job']['id'] .'?bidid=' . $data['id'];
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' has sent a bid on your job ' . $data['job']['title'];
                            break;
                        case 'bid_updated':
                            $notificationArray['bid'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = $data['job']['id'];
                            $notificationArray['jobTitle'] = $data['job']['title'];
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.job_details_url') . '/' . $data['job']['id'] .'?bidid=' . $data['id'];
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' has updated a bid on your job ' . $data['job']['title'];
                            break;
                        case 'bid_accepted':
                            $notificationArray['bid'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = $data['job']['id'];
                            $notificationArray['jobTitle'] = $data['job']['title'];
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.job_details_url') . '/' . $data['job']['id'] .'?bidid=' . $data['id'];
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' has accepted your bid on job ' . $data['job']['title'];
                            break;
                        case 'bid_declined':
                            $notificationArray['bid'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = $data['job']['id'];
                            $notificationArray['jobTitle'] = $data['job']['title'];
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.job_details_url') . '/' . $data['job']['id'] .'?bidid=' . $data['id'];
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' has declined your bid on job ' . $data['job']['title'];
                            break;
                        default:
                    }
                    break;
                case 'offer':
                    switch ($responseData['event']) {
                        case 'offer_created':
                            $notificationArray['offer'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = $data['job']['id'];
                            $notificationArray['jobTitle'] = $data['job']['title'];
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.job_details_url') . '/' . $data['job']['id'];
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' has sent a counter offer on job ' . $data['job']['title'];
                            break;
                        case 'offer_updated':
                            $notificationArray['offer'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = $data['job']['id'];
                            $notificationArray['jobTitle'] = $data['job']['title'];
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.job_details_url') . '/' . $data['job']['id'];
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' has updated a counter offer on job ' . $data['job']['title'];
                            break;
                        case 'offer_accepted':
                            $notificationArray['offer'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = $data['job']['id'];
                            $notificationArray['jobTitle'] = $data['job']['title'];
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.job_details_url') . '/' . $data['job']['id'];
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' has accepted your counter offer on job ' . $data['job']['title'];
                            break;
                        case 'offer_declined':
                            $notificationArray['offer'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = $data['job']['id'];
                            $notificationArray['jobTitle'] = $data['job']['title'];
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.job_details_url') . '/' . $data['job']['id'];
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' has declined your counter offer on job ' . $data['job']['title'];
                            break;
                        default:
                    }
                    break;
                case 'review':
                    switch ($responseData['event']) {
                        case 'review_sent':
                            $notificationArray['review'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = null;
                            $notificationArray['jobTitle'] = null;
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.reviews_url') . '/' . $notification['data']['receiver']['id'];
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' has given a review on your profile';
                            break;
                        default:
                    }
                    break;
                case 'feedback':
                    switch ($responseData['event']) {
                        case 'feedback_sent':
                            $notificationArray['feedback'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = $data['job']['id'];
                            $notificationArray['jobTitle'] = $data['job']['title'];
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.job_details_url') . '/' . $data['job']['id'];;
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' has given a feedback on job ' . $data['job']['title'];
                            break;
                        default:
                    }
                    break;
                case 'follow':
                    switch ($responseData['event']) {
                        case 'follow_sent':
                            $notificationArray['follow'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = null;
                            $notificationArray['jobTitle'] = null;
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.user_profile_url') . '/' . $notification['data']['sender']['id'];
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' started following you';
                            break;
                        default:
                    }
                    break;
                case 'invoice':
                    switch ($responseData['event']) {
                        case 'invoice_sent':
                            $notificationArray['invoice'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = $data['job']['id'];
                            $notificationArray['jobTitle'] = $data['job']['title'];
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.invoice_url') . '/' . $data['id'];
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' has sent an invoice on your job ' . $data['job']['title'];
                            break;
                        case 'invoice_pay':
                            $notificationArray['invoice'] = $data;
                            $notificationArray['slug'] = $key;
                            $notificationArray['jobId'] = $data['job']['id'];
                            $notificationArray['jobTitle'] = $data['job']['title'];
                            $notificationArray['url'] = config('app.client_base_url') . '/' . config('app.invoice_url') . '/' . $data['id'];
                            $notificationArray['description'] = ucwords($notification['data']['sender']['name']) .
                                ' has paid invoice on job ' . $data['job']['title'];
                            break;
                        default:
                    }
                    break;
                default:
            }
        }
    }

    $notificationArray['senderId'] = $notification['data']['sender']['id'];
    $notificationArray['senderName'] = $notification['data']['sender']['name'];
    $notificationArray['senderEmail'] = $notification['data']['sender']['email'];
    $notificationArray['senderPhoto'] = ($notification['data']['sender']['photo'] != null) ? $notification['data']['sender']['photo'] : null;
    $notificationArray['readAt'] = ($notification['read_at'] != null) ? $notification['read_at']->format('Y-m-d H:i:s') : null;
    $notificationArray['createdAt'] = $notification['created_at']->format('Y-m-d H:i:s');

    return $notificationArray;
}

function camelize($input, $separator = '_')
{
    return lcfirst(str_replace($separator, '', ucwords($input, $separator)));
}

/**
 * Convert under_score type array's keys to camelCase type array's keys
 * @param   array   $array array to convert
 * @return  array   $newArray array
 */

function camelCaseKeys($array) {
    $newArray = array();
    foreach($array as $key => $value) {
        if(is_string($key)) $key = Str::camel($key);
        if(is_array($value)) $value = camelCaseKeys($value);
        $newArray[$key] = $value;
    }
    return $newArray;
}

/** Function to get all the dates in given range*/
function getDatesFromRange($start, $end, $format = 'Y-m-d') {

    // Declare an empty array
    $array = array();

    // Variable that store the date interval
    // of period 1 day
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    // Use loop to store date into array
    foreach($period as $date) {
        $array[] = $date->format($format);
    }

    // Return the array elements
    return $array;
}
