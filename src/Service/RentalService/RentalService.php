<?php


namespace App\Service\RentalService;


use App\Entity\Rental;
use App\Repository\BookRepository;
use App\Repository\RentalRepository;

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

    public function changeStatus($id)
    {
        $rental = $this->rentalRepository->findOneBy(['id' => $id]);

        $status = $rental->getStatus();
        switch ($status) {
            case Rental::STATUS_RENTED:
                $newStatus = Rental::STATUS_RETURNED;
                $rental->setReturnDate(new \DateTime());
                break;
            case Rental::STATUS_WAITING:
                $newStatus = Rental::STATUS_RENTED;
                $rental->setRentDate(new \DateTime());
                $rental->setExpReturnDate((new \DateTime())->add(new \DateInterval('P30D')));
                break;
            case Rental::STATUS_ORDERED:
                $newStatus = Rental::STATUS_WAITING;
                break;
            default:
                $newStatus = $status;
        }
        $rental->setStatus($newStatus);
        return $this->rentalRepository->create($rental);
    }
}