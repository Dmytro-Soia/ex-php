<?php

namespace Jobtrek\ExPhp;

use Jobtrek\ExPhp\Data\User;
use Random\RandomException;

class ArraysAndLoops
{
    /**
     * Generate an array with 100 random numbers between 1 and 10
     * @return int[] // As you can see in the method return type, we cannot specify
     * the type in the array. This is a limitation of PHP type system, to address that,
     * we are forced to add PHPdoc `@return` annotation to tell the IDE witch
     * type we are returning in the array
     * @throws RandomException
     */
    public static function generateRandomArray(): array
    {
        $random = array();
        for ($i = 0; $i < 100; $i++) {
            $random[$i] = rand(1,10);
        }
        return $random;
    }

    /**
     * Count how many times each number appears in the array
     * @param int[] $array
     * @return array<int, int>
     */
    public static function countNumbers(array $array): array
    {
        return array_count_values($array);
    }

    /**
     * You get an array containing users, you have to filter users according to the
     * given field name (see user class) and value. Value types must also be compatible.
     * For example, age 18 will return only users with age field to 18
     * @param array<User> $users
     */
    public static function filterUsers(array $users, string $attribute, $value): array
    {
        return array_filter($users, function(User $user) use ($attribute, $value) {
            $name = $user->getName(); // todo.name
            $age = $user->getAge();
            if ($attribute === "getName") {
                return $name === $value;
            } else if ($attribute === "getAge") {
                return $age === $value;
            } else {
                return false;
            }
        });
    }

    /**
     * Transform the given array of users. All users name must have first letter in uppercase,
     * and odd ages should be incremented by 10, even ages are divided by 2 then incremented by 2
     * @param array<User> $users
     */
    public static function transformUsers(array $users): array
    {
        foreach ($users as $user) {
            $user->setName(ucwords($user->getName()));
            if ($user->getAge() % 2 == 0) {
                $user->setAge($user->getAge()/ 2 + 2);
            } else {
                $user->setAge($user->getAge() + 10); 
            }
        }
        return $users;
    }
}