<?php


namespace Restaurante\Producto\Domain;

use Restaurante\Shared\Domain\DomainError;

class ProductoNoExiste extends DomainError
{

   private string $sku;

    public function __construct(string $sku)
    {
        $this->sku = $sku;
    }

    public function errorCode(): string
    {
       return 'product_no_exist';
    }

    public function errorMessage(): string
    {
        return sprintf('the producto with the sku <%s> not exist',$this->sku);
    }
}
