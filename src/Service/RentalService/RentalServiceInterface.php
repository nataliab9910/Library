<?php


namespace App\Service\RentalService;

interface RentalServiceInterface
{
    public function create($user, $bookId);

    public function delete($id);

    public function changeStatus($id);
}