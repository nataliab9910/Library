<?php


namespace App\Controller;


use App\Service\RentalService\RentalServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class RentalController extends AbstractController
{
    /**
     * @Route("/admin/rental/change_status/{id}")
     */
    public function changeStatus(RentalServiceInterface $service, $id)
    {
        $rental = $service->changeStatus($id);

        return $this->json([
            'rental'=>$rental,
        ]);
    }
}