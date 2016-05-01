<?php
namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use AppBundle\Controller\BaseController;
use BackBundle\Form\AdType;
use AppBundle\Entity\Ad;
use AppBundle\Entity\School;

/**
 * @Route("/schools")
 */
class AdsController extends BaseController
{

    /**
     * @Route("/ads", name="back_schools_ads")
     * @Method({"GET"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function indexAction() {
        $schoolRepo = $this->getRepository('AppBundle:School');
        $schools = $schoolRepo->findAll();

        return $this->render('BackBundle:Ads:index.html.twig', array(
                'schools' => $schools
            )
        );
    }

    /**
     * @Route("/ads", name="back_schools_ads_show")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     * @Method({"POST"})
     */
    public function showAction(Request $request) {
        $id = $request->get('school_id');
        $schoolRepo = $this->getRepository('AppBundle:School');
        $form = $this->createForm(AdType::class, new Ad());
        $deleteForm = $this->createForm(AdType::class, new Ad());
        $school = $schoolRepo->find($id);

        if ($school === null){
            throw new NotFoundHttpException('School does not exist');
        }

        return $this->render('BackBundle:Ads:show.html.twig', array(
                'school' => $school,
                'form'   => $form->createView()
            )
        );
    }

    /**
     * @Route("/ads/{id}", requirements={"id" = "\d+"}, name="back_schools_ads_create")
     * @ParamConverter("school", class="AppBundle:School", options={"id" = "id"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     * @Method({"POST"})
     */
    public function createAction(Request $request, School $school) {
        $ad = new Ad();
        $ad->setSchool($school);
        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $ad->getFileName();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $brochuresDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/school_'.$school->getId();
            $file->move($brochuresDir, $fileName);

            $ad->setFileName($fileName);

            $em->persist($ad);
            $em->flush();

            $this->setFlash('notice', 'Publicité ajoutée');
        }
        else {
            $this->setFlash('failure', "Impossible d'ajouter cette publicité");
        }

        return $this->render('BackBundle:Ads:show.html.twig', array(
            'school' => $school,
            'form'   => $form->createView()
            )
        );
    }

    /**
     * @Route("{school_id}/ads/{id}/destroy", requirements={"school_id" = "\d+", "id" = "\d+"}, name="back_schools_ads_destroy")
     * @ParamConverter("school", class="AppBundle:School", options={"id" = "school_id"})
     * @ParamConverter("ad", class="AppBundle:Ad", options={"id" = "id"})
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     * @Method({"POST"})
     */
    public function destroyAction(Request $request, School $school, Ad $ad) {
        $fs = new Filesystem();
        $fs->remove(array($this->container->getParameter('kernel.root_dir').'/../web/uploads/school_'.$school->getId().'/'.$ad->getFileName()  ));

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($ad);
        $em->flush();

        $this->setFlash('notice', 'Publicité supprimée');

        exit(0);
    }
}
