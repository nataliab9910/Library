<?php


namespace App\Service\RentalService;


use App\Entity\Rental;
use App\Repository\BookRepository;
use App\Repository\RentalRepository;
use App\Service\RentalService\RentalServiceInterface;

class RentalService implements RentalServiceInterface
{
    private RentalRepository $rentalRepository;
    private BookRepository $bookRepository;

    public function __construct(
        RentalRepository $rentalRepository,
        BookRepository $bookRepository
    )
    {
        $this->rentalRepository = $rentalRepository;
        $this->bookRepository = $bookRepository;
    }

    public function create($user, $bookId)
    {
        $book = $this->bookRepository->findOneBy(['id' => $bookId]);

        $rental = new Rental();
        $rental->setBook($book);
        $rental->setOrderDate(new \DateTime());
        $rental->setReader($user);
        $rental->setStatus(Rental::STATUS_ORDERED);

        return $this->rentalRepository->create($rental);
    }

    public function delete($id)
    {
        $rental = $this->rentalRepository->findOneBy(['id'=>$id]);
        $this->rentalRepository->delete($rental);
    }
}