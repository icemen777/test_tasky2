<?php

namespace Core;

use \Fenom as Fenom;
use \Kilte\Pagination\Pagination as Pagination;
/**
 * Base controller
 *
 * PHP version 7.0
 */
abstract class Controller
{
    /** @var Fenom $fenom */
    public $fenom;
    public $admin = false;

    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];

    /**
     * Class constructor
     *
     * @param array $route_params  Parameters from the route
     *
     * @return void
     */
    public function __construct($route_params)
    {
        session_start();
        if(isset($_SESSION['admin'])&&($_SESSION['admin']==true)){
            $this->admin = true;
        }
        $this->route_params = $route_params;
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name  Method name
     * @param array $args Arguments passed to the method
     *
     * @return void
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * Before filter - called before an action method.
     *
     * @return void
     */
    protected function before()
    {
    }

    /**
     * After filter - called after an action method.
     *
     * @return void
     */
    protected function after()
    {
    }

    /**
     * Шаблонизация
     *
     * @param string $tpl Имя шаблона
     * @param array $data Массив данных для подстановки
     * @param Controller|null $controller Контроллер для передачи в шаблон
     *
     * @return mixed|string
     */
    public function template($tpl, array $data = array(), $controller = null) {
        $output = '';
        $data['admin'] = $this->admin;
        if (!preg_match('#\.tpl$#', $tpl)) {
            $tpl .= '.tpl';
        }
        if ($fenom = $this->getFenom()) {
            try {
                //$data['_core'] = $this->core;
                $data['_controller'] = !empty($controller) && $controller instanceof Controller
                    ? $controller
                    : $this;
                $output = $fenom->fetch($tpl, $data);
            }
            catch (Exception $e) {
                $this->core->log($e->getMessage());
            }
        }

        return $output;
    }

    /**
     * Получение экземпляра класса Fenom
     *
     * @return bool|Fenom
     */
    public function getFenom()
    {
        if (!$this->fenom) {
            try {
                if (!file_exists(PROJECT_CACHE_PATH)) {
                    mkdir(PROJECT_CACHE_PATH);
                }
                $this->fenom = Fenom::factory(PROJECT_TEMPLATES_PATH, PROJECT_CACHE_PATH, PROJECT_FENOM_OPTIONS);
            } catch (Exception $e) {
                $this->log($e->getMessage());
                return false;
            }
        }

        return $this->fenom;
    }

    /**
     * Возвращает массив с постраничной навигацией
     *
     * @param $totalItems
     * @param int $currentPage
     * @param int $itemsPerPage
     * @param int $neighbours
     *
     * @return array
     */
    public function getPagination($totalItems, $currentPage = 1, $itemsPerPage = 10, $neighbours = 2) {
        $pagination = new Pagination($totalItems, $currentPage, $itemsPerPage, $neighbours);

        return $pagination->build();
    }

    /**
     * Возвращает пункты меню сайта
     *
     * @return array
     */
    public function getMenu() {
        return array(
            'home' => array(
                'title' => 'Главная',
                'link' => '/',
            ),
            'news' => array(
                'title' => 'Страница',
                'link' => '/tasks/index',
            ),
            'test' => array(
                'title' => 'Другая страница',
                'link' => '/test/index',
            )
        );
    }

    public function redirect($url='/') {
        header("Location: ".$url);
        return;
    }

}
