<?php 
namespace App\Twig;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class NavExtension extends AbstractExtension
{
    const icon ='far fa-circle';
    public function getFunctions():array
    {
        return[
            new TwigFunction('sidebar',[$this,'getNavs'])
        ];
    }

    public function getNavs()
    {
        return 
        [
            'user'=>
            [
                [
                    'name'=>'Client',
                    'links'=>
                        [
                            [
                                'name'=>'Clients',
                                'path'=>'admin_client_index'
                            ],
                            [
                                'name'=>'New',
                                'path'=>'admin_client_new'
                            ]
                        ]
                ],
                [
                    'name'=>'Abonnement',
                    'links'=>
                        [
                            [
                                'name'=>'Abonnements',
                                'path'=>'admin_abonnement_index',

                            ],
                            [
                                'name'=>'New',
                                'path'=>'admin_abonnement_new'
                            ]
                        ]
                ],
                [
                    'name'=>'Vehicule',
                    'path'=>'vehicule_index',
                    'icon'=>'fa fa-car',
                    'links'=>
                        [
                            [
                                'name'=>'New',
                                'path'=>'vehicule_new'
                            ]
                        ]
                ],
                [
                    'name'=>'Modele',
                    'path'=>'admin_modele_index',
                ],
                [
                    'name'=>'Marque',
                    'path'=>'admin_mark_index',
                ],
                [
                    'name'=>'Categorie',
                    'path'=>'category_index',
                ],
            ],
            'admin'=>
            [
                [
                    'name'=>'user',
                    'path'=>'user_index',
                    'icon'=>'fas fa-users'
                ],
                [
                    'name'=>'Method Payment',
                    'path'=>'payment_method_index',
                ],
                [
                    'name'=>'Formule',
                    'path'=>'admin_formule_index',
                ],
                [
                    'name'=>'pays',
                    'path'=>'user_index',
                    'icon'=>self::icon
                ],
                [
                    'name'=>'Ville',
                    'path'=>'user_index',
                    'icon'=>self::icon
                ],
                [
                    'name'=>'pays',
                    'path'=>'user_index',
                    'icon'=>self::icon
                ],
            ],
            'dashboard'=>
            [
                [
                    'name'=>'Dashbord 1',
                    'path'=>'admin',
                    'icon'=>self::icon
                ],
                [
                    'name'=>'Profil',
                    'path'=>'profile_index',
                    'icon'=>self::icon
                ]
            ],
            'editor'=>
            [
                [
                    'title'=>'Category',
                    'path'=>'category_index',
                    'icon'=>'far fa-circle'
                ]
            ]
        ];
    }
}