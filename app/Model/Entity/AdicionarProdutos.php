<?php

namespace App\Model\Entity;

use App\Config\src\Database;

class AdicionarProdutos
{
    public $id;
    public $nome;
    public $price;
    public $stock;
    public $descricao;
    public $category_id;
    public $variants;
    public $exibir;
    public $destaque;
    public $files;
    public $comprimento;
    public $altura;
    public $largura;
    public $peso;
    public $free;

    public function cadastrar()
    {

        $dbProducts = new Database('products');
        $dbImagens = new Database('product_images');
        $dbVariants = new Database('product_variants');

        $formattedPrice = floatval(str_replace(['R$', '.', ','], ['', '', '.'], $this->price));
        $cleanedLength = floatval(str_replace('CM', '', str_replace(',', '.', $this->comprimento)));
        $cleanedWidth = floatval(str_replace('CM', '', str_replace(',', '.', $this->largura)));
        $cleanedHeight = floatval(str_replace('CM', '', str_replace(',', '.', $this->altura)));
        $cleanedWeight = floatval(str_replace('KG', '', str_replace(',', '.', $this->peso)));

        $this->id = $dbProducts->insert([
            'id_tenant' => $_SESSION['usuarios']['codEmpresa'],
            'name' => $this->nome,
            'price' => $formattedPrice,
            'stock' => $this->stock,
            'description' => $this->descricao,
            'category_id' => $this->category_id,
            'exibir' => $this->exibir,
            'destaque' => $this->destaque,
            'comprimento' => $cleanedLength,
            'free' => $this->free,
            'largura' => $cleanedWidth,
            'altura' => $cleanedHeight,
            'peso' => $cleanedWeight
        ]);

        if (!empty($this->variants['size'])) {
            foreach ($this->variants['size'] as $index => $size) {
                $color = $this->variants['color'][$index];
                $variantStock = $this->variants['stock'][$index];

                $dbVariants->insert([
                    'product_id' => $this->id,
                    'size' => $size,
                    'color' => $color,
                    'stock' => $variantStock
                ]);
            }
        }

        $uploadDir = 'resources/view/assets/uploads/' . $_SESSION['usuarios']['codEmpresa'] . '/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($this->files as $base64Image) {
            list($type, $data) = explode(';', $base64Image);
            list(, $data) = explode(',', $data);
            $decodedImage = base64_decode($data);
            $fileName = md5(uniqid()) . '.webp';
            $filePath = $uploadDir . $fileName;
            file_put_contents($filePath, $decodedImage);

            $dbImagens->insert([
                'product_id' => $this->id,
                'image_url' => $fileName
            ]);
        }

        if (empty($this->id)) {
            return false;
        } else {
            return true;
        }
    }
}
