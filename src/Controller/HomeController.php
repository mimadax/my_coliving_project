<?php

namespace App\Controller;

use App\Form\RechercheType;
use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    // Page d'accueil
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        // Créer le formulaire de recherche
        $form = $this->createForm(RechercheType::class);

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Page de résultats de recherche
    #[Route('/recherche', name: 'recherche_resultats')]
    public function recherche(Request $request, AnnonceRepository $annonceRepository): Response
    {
        // Récupérer les données du formulaire via les paramètres GET
        $formData = $request->query->all('recherche'); // 'recherche' est le nom du tableau dans l'URL
        $localisation = $formData['localisation'] ?? null;

        $annonces = [];

        if ($localisation) {
            // Rechercher les annonces par localisation
            $annonces = $annonceRepository->findBy(['localisation' => $localisation]);
        }

        return $this->render('home/recherche.html.twig', [
            'annonces' => $annonces,
            'localisation' => $localisation,
        ]);
    }
}




