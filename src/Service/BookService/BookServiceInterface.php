<?php


namespace App\Service\BookService;

interface BookServiceInterface
{
    public function create($title, $isbn, $pages);

    public function delete($id);
}