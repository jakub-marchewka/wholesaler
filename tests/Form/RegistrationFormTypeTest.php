<?php

declare(strict_types=1);

namespace App\Tests\Form;

use App\Entity\User;
use App\Form\RegistrationFormType;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Form\Extension\Core\CoreExtension;
use Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\ConstraintViolationList;

class RegistrationFormTypeTest extends TypeTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $validator = $this->createMock('\Symfony\Component\Validator\Validator\ValidatorInterface');
        $validator->method('validate')->will($this->returnValue(new ConstraintViolationList()));
        $formTypeExtension = new FormTypeValidatorExtension($validator);
        $coreExtension = new CoreExtension();

        $this->factory = Forms::createFormFactoryBuilder()
            ->addExtensions($this->getExtensions())
            ->addExtension($coreExtension)
            ->addTypeExtension($formTypeExtension)
            ->getFormFactory();
    }


    public function testSubmitValidData()
    {
        $user = new User();
        $form = $this->factory->create(RegistrationFormType::class, $user);
        $form->submit($this->getFormData());
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($this->getExpectedUser(), $user);
    }

    public function testCustomFormView()
    {
        $formData = $this->getExpectedUser();
        $view = $this->factory->create(RegistrationFormType::class, $formData)
            ->createView();
        $this->assertSame($formData->getEmail(), $view->vars['value']->getEmail());
    }

    #[ArrayShape(
        [
            'email' => "string",
            'firstname' => "string",
            'surname' => "string",
            'phone' => "string",
            'nip' => "string",
            'agreeTerms' => "bool",
            'plainPassword' => "string"
        ]
    )] public function getFormData(): array
    {
        return [
            'email' => 'test@test.com',
            'firstname' => 'test',
            'surname' => 'test',
            'phone' => '123123123',
            'nip' => '123123123',
            'agreeTerms' => true,
            'plainPassword' => 'Test123@'
        ];
    }

    public function getExpectedUser(): User
    {
        $user = new User();
        $user->setEmail('test@test.com');
        $user->setFirstname('test');
        $user->setSurname('test');
        $user->setPhone('123123123');
        $user->setNip('123123123');
        return $user;
    }
}
