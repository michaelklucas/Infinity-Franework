<?php

namespace App\Model\Entity;

use App\Config\src\Database;
use Exception;


class Produtos
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

    public function atualizar()
{
    try {
        $dbProducts = new Database('products');
        $dbImagens = new Database('product_images');
        $dbVariants = new Database('product_variants');

        $formattedPrice = floatval(str_replace(['R$', '.', ','], ['', '', '.'], $this->price));
        $cleanedLength = floatval(str_replace('CM', '', str_replace(',', '.', $this->comprimento)));
        $cleanedWidth = floatval(str_replace('CM', '', str_replace(',', '.', $this->largura)));
        $cleanedHeight = floatval(str_replace('CM', '', str_replace(',', '.', $this->altura)));
        $cleanedWeight = floatval(str_replace('KG', '', str_replace(',', '.', $this->peso)));

        // Atualizar o produto existente
        $result = $dbProducts->update('id =' . $this->id, [
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

        if ($result === false) {
            return false; // Erro ao atualizar o produto
        }

        if (!empty($this->variants['size'])) {
            $existingVariantsQuery = $dbVariants->select('product_id =' . $this->id);
            $existingVariants = $existingVariantsQuery->fetchAll();

            $existingVariantIds = array_column($existingVariants, 'id');

            foreach ($this->variants['size'] as $index => $size) {
                $color = $this->variants['color'][$index];
                $variantStock = $this->variants['stock'][$index];

                if (isset($existingVariantIds[$index])) {
                    $updateResult = $dbVariants->update('id =' . $existingVariantIds[$index], [
                        'size' => $size,
                        'color' => $color,
                        'stock' => $variantStock
                    ]);
                    if ($updateResult === false) {
                        return false; // Erro ao atualizar a variante
                    }
                } else {
                    $insertResult = $dbVariants->insert([
                        'product_id' => $this->id,
                        'size' => $size,
                        'color' => $color,
                        'stock' => $variantStock
                    ]);
                    if ($insertResult === false) {
                        return false; // Erro ao inserir a variante
                    }
                }
            }

            foreach ($existingVariantIds as $key => $variantId) {
                if (!isset($this->variants['size'][$key])) {
                    $deleteResult = $dbVariants->delete("id = $variantId");
                    if ($deleteResult === false) {
                        return false; // Erro ao deletar a variante
                    }
                }
            }
        }

        $uploadDir = 'resources/view/assets/uploads/' . $_SESSION['usuarios']['codEmpresa'] . '/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $existingImagesQuery = $dbImagens->select('product_id =' . $this->id);
        $existingImages = $existingImagesQuery->fetchAll();
        $existingImagePaths = array_column($existingImages, 'image_url');

        foreach ($this->files as $index => $file) {
            if (strpos($file, 'data:image/') === 0) {
                list($type, $data) = explode(';', $file);
                list(, $data) = explode(',', $data);
                $decodedImage = base64_decode($data);
                $fileName = md5(uniqid()) . '.webp';
                $filePath = $uploadDir . $fileName;

                if (!file_put_contents($filePath, $decodedImage)) {
                    return false; // Erro ao salvar a imagem
                }

                $insertImageResult = $dbImagens->insert([
                    'product_id' => $this->id,
                    'image_url' => $fileName
                ]);
                if ($insertImageResult === false) {
                    return false; // Erro ao inserir a imagem
                }
            } else {
                $baseName = basename($file);
                $insertImageResult = $dbImagens->insert([
                    'product_id' => $this->id,
                    'image_url' => $baseName
                ]);
                if ($insertImageResult === false) {
                    return false; // Erro ao inserir a imagem
                }
            }
        }

        foreach ($existingImages as $existingImage) {
            if (!in_array($existingImage['image_url'], $this->files)) {
                $deleteResult = $dbImagens->delete('id =' . $existingImage['id']);
                if ($deleteResult === false) {
                    return false; // Erro ao deletar a imagem
                }

                $filePath = $uploadDir . $existingImage['image_url'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        return true; // Sucesso
    } catch (Exception $e) {
        // Log do erro se necessário
        return false; // Retorna falso em caso de qualquer exceção
    }
}


public function apagar(){

    $dbProducts = new Database('products');

    $result = $dbProducts->delete('id =' . $this->id);

    return isset($result) ? true : false;

}

    public static function getProdutos($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('products'))->select($where, $order, $limit, $fields);
    }


    public static function getVariants($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('product_variants'))->select($where, $order, $limit, $fields);
    }

    public static function getImagensProdutos($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('product_images'))->select($where, $order, $limit, $fields);
    }
}
