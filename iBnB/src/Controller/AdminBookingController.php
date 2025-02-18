<?php

namespace App\Controller;


use App\Entity\Booking;
use App\Form\AdminBookingType;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminBookingController extends AbstractController
{
   
    /**
     * @Route("/admin/bookings", name="admin_booking_index")
     */
    public function index(BookingRepository $repo)
    {
        return $this->render('admin/booking/index.html.twig', [
            'bookings' => $repo->findAll()
        ]);
    }

     /**
     * permet d'éditer une réservation
     *
     * @route("/admin/bookings/{id}/edit", name="admin_booking_edit")
     * @param Booking $booking
     * @return Response
     */
    public function edit(Booking $booking, Request $request,EntityManagerInterface $manager){

        $form = $this->createForm(AdminBookingType::class, $booking);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $booking->setAmount(0);

            $manager->persist($booking);
            $manager->flush();

            $this->addFlash(
                'success',
                "la réservation <strong>{$booking->getId()} </strong> a bien été modifiée !"
            );
        }

        return $this->render('admin/booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form->createView()
        ]);
    }
     /**
         * permet de supprimer une réservation
         *
         * @Route("/admin/bookings/{id}/delete", name="admin_booking_delete")
         * 
         * @return Response
         */
        public function delete(Booking $booking, EntityManagerInterface $manager){
            $manager->remove($booking);
            $manager->flush();

            $this->addFlash(
                'success',
                "La réservation a bien été supprimée"
            );

            return $this->redirectToRoute("admin_booking_index");

        }
}
