<?php
namespace App\Service;

use App\Repository\CatalogsRepository;
use App\Repository\MaincatsRepository;
use App\Repository\CategoriesRepository;
use App\Repository\BrandsRepository;
use App\Repository\ModelsRepository;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class CommonService
 * @package App\Service
 */
final class CommonService
{
     /**
     * @var CatalogsRepository
     */
    private $catalogsRepository;  
    /**
     * @var MaincatsRepository
     */
    private $maincatsRepository;     
    /**
     * @var CategoriesRepository
     */
    private $categoriesRepository;     
    /**
     * @var BrandsRepository
     */
    private $brandsRepository;   
    /**
     * @var ModelsRepository
     */
    private $modelsRepository; 

    /**
     * CommonService constructor.
     * @param CatalogsRepository $catalogsRepository
     * @param MaincatsRepository $maincatsRepository
     * @param CategoriesRepository $categoriesRepository
     * @param BrandsRepository $brandsRepository
     * @param ModelsRepository $modelsRepository
     */
    public function __construct(
        CatalogsRepository $catalogsRepository,
        MaincatsRepository $maincatsRepository,
        CategoriesRepository $categoriesRepository,
        BrandsRepository $brandsRepository,
        ModelsRepository $modelsRepository
    ){
    //public function __construct(){
        //$this->countriesRepository = new CountriesRepository();
        $this->catalogsRepository = $catalogsRepository;      
        $this->maincatsRepository = $maincatsRepository;     
        $this->categoriesRepository = $categoriesRepository;    
        $this->brandsRepository = $brandsRepository;
        $this->modelsRepository = $modelsRepository;
    }

     /**
     * @return array|null
     */
    public function getInitialInfo(): ?array
    {
        $catalogs = $this->catalogsRepository->findAll();

        for($i = 0; $i<count($catalogs);$i++){
            $catalogId = $catalogs[$i]->getCatalogId();
            $where = array('maincatCatalog' => $catalogId);
            $maincats = $this->maincatsRepository->findBy($where);

            for($j=0;$j<count($maincats);$j++){
                $maincatId = $maincats[$j]->getMaincatId();
                $where = array('categoryMaincat' => $maincatId);
                $categories = $this->categoriesRepository->findBy($where);
                $maincats[$j]->setMaincatCategories($categories);
            }
            $catalogs[$i]->setCatalogMaincats($maincats);
        }

        $brands = $this->brandsRepository->findAll();
        for($i = 0; $i<count($brands);$i++){
            $brandId = $brands[$i]->getBrandId();
            $where = array('modelBrand' => $brandId);
            $models = $this->modelsRepository->findBy($where);

            $brands[$i]->setBrandModels($models);
        }

        return $catalogs;
    }

}
