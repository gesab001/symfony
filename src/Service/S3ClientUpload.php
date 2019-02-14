<?php
/**
 * Created by PhpStorm.
 * User: gesab001
 * Date: 2/13/19
 * Time: 7:24 PM
 */

namespace App\Service;

use Aws\AwsClient\S3

class S3ClientUpload
{

    public function getHappyMessage()
    {
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
}