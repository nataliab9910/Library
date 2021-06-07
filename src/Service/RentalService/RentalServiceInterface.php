<?php


namespace App\Service\RentalService;

interface RentalServiceInterface
{
    public function create($userId, $bookId);
}