<?php

namespace CTRLPlusN\Modules\ReviewManagement\Twig\Extension;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use CTRLPlusN\Modules\ReviewManagement\Form\ResearchType;

class ResearcherExtension extends \Twig_Extension {

    /**
     * EntityManager
     */
    private $em;

    /**
     * ContainerInterface
     */
    protected $container;

    public function __construct(ObjectManager $em, ContainerInterface $container) {
        $this->em = $em;
        $this->container = $container;
    }

    /**
     * {{ searcher() }}
     * @return type
     */
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('ResearchForm', array($this, 'getView'), array('is_safe' => array('html'))),
        );
    }

    /**
     * 
     * @return Vue du formulaire de recherche
     */
    public function getView() {
        $form = $this->container->get('form.factory')->create(ResearchType::class, null);
        return $this->container->get('review.researcher.helper')->view($form);
    }

    /**
     * Retourne les résultats de la recherche
     * @return Array
     */
    public function getResults($string, $num = 1) {
        return $this->search($string, $num);
    }

    /**
     * QueryBuilder de recherche des posts
     */
    protected function search($string, $num) {
        return $this->em->getRepository('Review:Post')->researchInPosts($string, $num);
    }

    public function getName() {
        return 'review_researcher_extension';
    }

}
