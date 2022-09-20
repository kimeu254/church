<?php


namespace App\Transformers\Messages;

class MessageTransformer
{
    public function transform($user, $message)
    {
        $string = $this->getUserProperties($user);

        $message = str_replace($string[0], $string[1], $message);

        return $message;
    }


    public function getUserProperties($user)
    {
        $replace = [
            "{name}",
            "{email}",
            "{phone_number}",
            "{gender}"
        ];

        $replaceValues = [
            explode(" ", $user->name)[0],
            $user->email,
            $user->phone_number,
            $user->gender
        ];

        return [$replace, $replaceValues];

    }

    public function getColumnListing()
    {
        return [
            'name',
            'email',
            'phone_number'
        ];
    }

}