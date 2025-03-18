<?php

use Jobtrek\ExPhp\ArraysAndLoops;
use Jobtrek\ExPhp\Data\User;

describe("Arrays and loops", function () {
    test("Array with 100 random numbers between 1 and 10", function () {
        expect(ArraysAndLoops::generateRandomArray())
            ->toBeArray()
            ->toHaveLength(100)
            ->and(max(ArraysAndLoops::generateRandomArray()))
            ->toBeLessThanOrEqual(10)
            ->and(min(ArraysAndLoops::generateRandomArray()))
            ->toBeGreaterThanOrEqual(1)
            ->and(ArraysAndLoops::generateRandomArray())
            ->each->toBeInt()
            ->and(
                array_diff(
                    ArraysAndLoops::generateRandomArray(),
                    ArraysAndLoops::generateRandomArray()
                )
            )
            ->toHaveLength(0);
    });
    test("Count frequency of apparition in array", function () {
        $data = ArraysAndLoops::countNumbers([0, 0, 1, 2, 3, 5, 2, 3, 4, 3, 3, 3, 4]);
        expect($data)
            ->toBeArray()
            ->and(
                array_diff($data, [
                    0 => 2, 1 => 1, 2 => 2, 3 => 5, 4 => 2, 5 => 1
                ])
            )
            ->toHaveLength(0);
    });
    test("Filter users array", function () {
        $data = [
            new User("Archibald", 20),
            new User("Dana", 28),
            new User("Emmalee", 18),
            new User("Jacen", 34),
            new User("Jacen", 28),
        ];
        expect(ArraysAndLoops::filterUsers($data, "getName", "Archibald"))
            ->toBeArray()
            ->toHaveLength(1)
            ->and(ArraysAndLoops::filterUsers($data, "getName", "Jacen"))
            ->toBeArray()
            ->toHaveLength(2)
            ->and(ArraysAndLoops::filterUsers($data, "getAge", 20))
            ->toBeArray()
            ->toHaveLength(1)
            ->and(ArraysAndLoops::filterUsers($data, "getAge", 28))
            ->toBeArray()
            ->toHaveLength(2)
            ->and(ArraysAndLoops::filterUsers($data, "getAge", "28"))
            ->toBeArray()
            ->toHaveLength(0);
    });
    test("User transformation", function () {
        $data = [
            new User("toto", 21),
            new User("Porsha", 28),
            new User("felton", 17),
            new User("jacen", 34),
        ];
        $correct = [
            new User("Toto", 31),
            new User("Porsha", 16),
            new User("Felton", 27),
            new User("Jacen", 19),
        ];
        expect(ArraysAndLoops::transformUsers($data))
            ->toBeArray()
            ->toEqual($correct);
    });
});
