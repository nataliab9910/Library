<?php


namespace App\Service\RentalService;

interface RentalServiceInterface
{
    public function create($user, $bookId);
}