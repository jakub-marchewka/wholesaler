<?php

declare(strict_types=1);

namespace App\Tests\Form;

use App\Form\RegistrationFormType;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Validation;

class RegistrationFormTypeTest extends TypeTestCase
{
    protected function getExtensions(): array
    {
        $validator = Validation::createValidator();

        // or if you also need to read constraints from annotations
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        return [
            new ValidatorExtension($validator),
        ];
    }


    public function testSubmitValidData()
    {
        $formData = [
            'email' => 'test@test.pl',
            'agreeTerms' => true
        ];
        $form = $this->factory->create(RegistrationFormType::class);
        $form->submit($formData);
    }
}
