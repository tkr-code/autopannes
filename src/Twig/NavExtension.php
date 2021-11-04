<?php 
namespace App\Twig;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class NavExtension extends AbstractExtension
{
    private $translator;
    public function __construct(TranslatorInterface $translatorInterface)
    {
        $this->translator = $translatorInterface;
    }
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
                    'icon'=>'fas fa-users',
                    'links'=>
                        [
                            [
                                'name'=>'Clients',
                                'path'=>'admin_client_index'
                            ],
                            [
                                'name'=>'Nouveau Client',
                                'path'=>'admin_client_new'
                            ],
                        ]
                ],
                [
                    'name'=>'Souscription',
                    'icon'=>'far fa-clipboard',
                    'path'=>'admin_souscription'
                ],
                [
                    'name'=>'Abonnement',
                    'icon'=>'fas fa-clipboard-check',
                    'links'=>
                        [
                            [
                                'name'=>'Abonnements',
                                'path'=>'admin_abonnement_index',
                                
                            ],
                            [
                                'name'=>'New Abonnement',
                                'path'=>'admin_abonnement_new',
                            ],
                        ]
                ],
                [
                    'name'=>'Vehicule',
                    'icon'=>'fa fa-car',
                    'links'=>
                        [
                            [
                                'name'=>'Vehicules',
                                'path'=>'vehicule_index'
                            ]
                        ]
                ],
                // [
                //     'name'=>'Modele',
                //     'path'=>'admin_modele_index',
                // ],
                // [
                //     'name'=>'Marque',
                //     'path'=>'admin_mark_index',
                // ],
                // [
                //     'name'=>'Categorie',
                //     'path'=>'category_index',
                // ],
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
                    'links'=>[
                        [
                            'name'=>'Methodes de paiment',
                            'path'=>'payment_method_index',
                        ],
                        [
                            'name'=>'New Methode de paiement',
                            'path'=>'payment_method_new',
                        ]
                    ]
                ],
                [
                    'name'=>'Formule',
                    'links'=>[
                        [
                            'name'=>'Formules',
                            'path'=>'admin_formule_index',
                        ],
                        [
                            'name'=>'New Formule',
                            'path'=>'admin_formule_new',
                        ]
                    ]
                ],
                
            ],
            'navs'=>
            [
                [
                    'name'=>$this->translator->trans('Dashboard'),
                    'icon'=>'fas fa-tachometer-alt',
                    'links'=>[
                        [
                            'name'=>$this->translator->trans('Dashboard').' 1',
                            'path'=>'admin',
                        ]
                    ]
                ],
                [
                    'name'=>'Profile',
                    'path'=>'profile_index',
                    'icon'=>'fas fa-user'
                ]
            ],
            'editor'=>
            [
                [
                    'title'=>'Category',
                    'path'=>'category_index',
                ]
            ]
        ];
    }
}