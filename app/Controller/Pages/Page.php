<?php

namespace App\Controller\Pages;

use App\Model\Entity\Modulos;
use App\Utils\View;
use App\Model\Entity\Notificacoes;
use App\Model\Entity\Usuarios;


class Page
{

  private static function getHeader()
  {

    $usuario = new Usuarios();
    $resultado = Usuarios::getPerfilAssociar('cod_user = "' . $_SESSION['usuarios']['usuarioCode'] . '"');

    while ($usuario = $resultado->fetchObject(Usuarios::class)) {
      $_SESSION['usuarios']['codeEmpresa'] = $usuario->cod_empresa;
    }


    return View::render('pages/Painel/Header', [
      'nome' => $_SESSION['usuarios']['nome'],
      'modulos' => self::getModulos(),
      'notificacoes' => self::getNotificacao(),
      'quantidade' => self::getQuantidade(),
      'codEmpresa' => $_SESSION['usuarios']['codeEmpresa'],
      'codUser' => $_SESSION['usuarios']['usuarioCode']
    ]);
  }


  private static function getNotificacao()
  {

    $obNotificacoes = new Notificacoes;
    $notificacoes = '';

    $results = Notificacoes::getNotificacoes('id_usuario = "' . $_SESSION['usuarios']['id'] . '" AND visualizado = "0" OR global = 1', 'criado DESC', '15');

    while ($obNotificacoes = $results->fetchObject(Notificacoes::class)) {

      $dataAtual = strtotime('now');
      $dataNotificacao = strtotime($obNotificacoes->criado);

      if ($dataNotificacao > $dataAtual) {
        $diferenca = $dataNotificacao - $dataAtual;
      } else {
        $diferenca = $dataAtual - $dataNotificacao;
      }

      $horas = floor(($diferenca % (60 * 60 * 24)) / (60 * 60));

      $notificacoes .= View::render('pages/Notificacao/PartNotificacao', [
        'id' => $obNotificacoes->id,
        'titulo' => $obNotificacoes->titulo,
        'mensagem' => $obNotificacoes->mensagem,
        'testeid' => $obNotificacoes->rota ? 'href="' . URL . $obNotificacoes->rota . '/' . $obNotificacoes->id_aprovacao . '"' : 'data-bs-toggle="modal" data-bs-target="#modalToggle' . $obNotificacoes->id . '"',
        'tempo' => $horas

      ]);
    }
    return $notificacoes;
  }


  private static function getQuantidade()
  {

    $obQuantidade = new Notificacoes;
    $Quantidade = '';

    $results = Notificacoes::getNotificacoes('id_usuario = "' . $_SESSION['usuarios']['id'] . '" AND visualizado = "0" OR global = 1', null, null, 'COUNT(id) as Total');

    while ($obQuantidade = $results->fetchObject(Notificacoes::class)) {

      $Quantidade .= View::render('pages/Notificacao/PartQuantidade', [
        'numero' => $obQuantidade->Total,
      ]);
    }
    return $Quantidade;
  }

  private static function getFooter()
  {

    return View::render('pages/Painel/Footer');
  }

  public static function getPagination($request, $obPagination)
  {

    $pages = $obPagination->getPages();
    if (count($pages) <= 1) return '';
    $links = '';
    $url = $request->getRouter()->getCurrentUrl();
    $queryParams = $request->getQueryParams();



    foreach ($pages as $page) {

      $queryParams['page'] = $page['page'];
      $link = $url . '?' . http_build_query($queryParams);
      $links .= View::render('pages/Paginacao/Link', [
        'page' => $page['page'],
        'link' => $link,
        'active' => $page['current'] ? 'active' : ''
      ]);
    }

    return View::render('pages/Paginacao/Box', [
      'links' => $links
    ]);
  }

  public static function getModulos()
  {

    $obModulos = new Modulos;
    $modulos = '';

    $results = Modulos::getModulos('status = 1 AND adm = "' . $_SESSION['usuarios']['empresa'] . '"');

    while ($obModulos = $results->fetchObject(Modulos::class)) {

      $modulos .= View::render('pages/Modulos/PartModulos', [
        'nomemodulo' => $obModulos->nomemodulo,
        'icone' => $obModulos->icone,
        'descricao' => $obModulos->descricao,
      ]);
    }
    return $modulos;
  }

  public static function notification()
  {

    $obNotificacoes = new Notificacoes;
    $notifications = '';

    $results = Notificacoes::getNotificacoes('id_usuario = "' . $_SESSION['usuarios']['id'] . '" AND visualizado = "0" OR global = 1', 'criado DESC', '15');

    while ($obNotificacoes = $results->fetchObject(Notificacoes::class)) {
      $notifications .= View::render('pages/Notificacao/Notificacao', [
        'id' => $obNotificacoes->id,
        'titulo' => $obNotificacoes->titulo,
        'mensagem' => $obNotificacoes->mensagem,

      ]);
    }
    return $notifications;
  }


  public static function getPage($title, $content)
  {
    return View::render('pages/Painel/Page', [
      'title' => $title,
      'header' => self::getHeader(),
      'content' => $content,
      'footer' => self::getFooter()
    ]);
  }
}
