<?php

namespace Restaurante\Producto\Domain;

use Restaurante\Shared\Domain\DomainError;

final class ProductoSimpleDuplicado extends DomainError
{

    Private string $sku;

    public function __construct(string $sku)
    {
        parent::__construct();
        $this->sku = $sku;
    }

    public function errorCode(): string
    {
        return 'product_existing';
    }

    public function errorMessage(): string
    {
        return sprintf('the producto <%s> already exist',$this->sku);
    }
}
