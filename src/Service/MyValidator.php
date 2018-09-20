<?php
namespace App\Service;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class MyValidator{

    /**
    * @var ValidatorInterface
    */
    private $validator;
    

    /*
    * @param ValidatorInterface $validator
    */
    public function __construct(        
        ValidatorInterface $validator
    ){
        $this->validator = $validator;
    }


    public function validate($entity, $param2 = null, $groups = array()){       
         //validate sysAccount fields common for update or for complete registration
         $errors = $this->validator->validate($entity, null, $groups);

         if (count($errors) > 0) {
             $errorsString = (string) $errors;
 
             throw new BadRequestHttpException($errorsString);
         }
    }

}