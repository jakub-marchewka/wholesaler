<?php

declare(strict_types=1);

namespace App\Tests\Form;

use App\Entity\ProductVat;
use App\Form\ProductVatType;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Test\TypeTestCase;

class ProductVatTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'value' => 23,
        ];

        $productVat = new ProductVat();

        $form = $this->factory->create(ProductVatType::class, $productVat);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertTrue($form->isValid());
        $this->assertEquals(23, $form->get('value')->getData());
    }
}
