<?php

namespace App\Controller\Pages;

use App\Utils\View;


class Page
{

  private static function getHeader()
  {
    return View::render('pages/Painel/Header');
  }

  private static function getFooter()
  {
    return View::render('pages/Painel/Footer');
  }


  public static function getPage($title, $content, $request)
  {
    return View::render('pages/Painel/Page', [
      'header' => self::getHeader($request),
      'content' => $content,
      'footer' => self::getFooter()
    ]);
  }
}
