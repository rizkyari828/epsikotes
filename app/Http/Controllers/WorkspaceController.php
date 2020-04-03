<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\SmartUI\UI;
use App\Model\Menus;
use App\Model\PersonalInformations;


class WorkspaceController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    protected $_ui;

    public function __construct(UI $_ui){
        $this->_ui = $_ui;
    }

    public function index(Request $request)
    {
        


        $userName  = $request->session()->get('user.username');
                $personId  = $request->session()->get('user.personId');
        if(isset($userName)){
          
            $tempAllMenu = $this->getMenu();
            $page_nav = $this->createTree($personId,$tempAllMenu, null);

            UI::register('nav', 'App\Lib\SmartUI\Components\Nav');

            $nav_page_html = $this->_ui->create_nav($page_nav)->print_html(true);

            $param = array('content'=>'ajax/layout','param'=>array('nav'=>$nav_page_html));

            //$this->createMenu($this->getMenu());

            return view('workspace',$param);
        }else{
          return view('loginPage'); 
        }


    }

    public function getMenu(){

        $menus = new Menus();
        $allListMenu = array();
        $indexTreeList = 0;
        foreach ($menus->getAllMenu() as $indexMenu => $rowMenu ){
           // $allListMenu[$rowMenu->index_arr]['title'] = $rowMenu->menu_name;
          //  $allListMenu[$rowMenu->index_arr]['id'] = $rowMenu->parent;
            $allListMenu[$indexTreeList]['parentId'] = $rowMenu->parent;
            $allListMenu[$indexTreeList]['menu'] = $rowMenu->menu;
            $allListMenu[$indexTreeList]['menuId'] = $rowMenu->menu_id;
            $allListMenu[$indexTreeList]['parent'] = $rowMenu->index_parent;
            $allListMenu[$indexTreeList]['child'] = $rowMenu->index_arr;
            $allListMenu[$indexTreeList]['title'] = $rowMenu->menu_name;
            if(isset($rowMenu->index_parent)){
                $allListMenu[$indexTreeList]['url'] = $rowMenu->url_menu;
            }


            $indexTreeList++;
        }

        return $allListMenu;
    }



    public function createTree($personId,$elements, $parentId){
        $branch = array();
        $menuPeopleEnter =  $this->getMenuPeopleEnter($personId);

        foreach ($elements as $element) {
            if(in_array($element['menuId'].$element['parentId'], $menuPeopleEnter) || ($personId == 1)){
                if ($element['parent'] == $parentId) {
                    $children = $this->createTree($personId,$elements, $element['child']);
                    if ($children) {
                        $element['sub'] = $children;
                    }
                    //unset($element['parent']);
                    $branch[$element['child']] = $element;
                    unset($branch[$element['child']]['parent']);
                    unset($branch[$element['child']]['child']);
                    unset($elements[$element['parent']]);
                }
            }
        }
        return $branch;
    }

    public function getMenuPeopleEnter($personId = 0){
        $PersonalInformations = new PersonalInformations();
        $eachMenu = array();
        foreach ($PersonalInformations->getEachMenuPersonalEnter($personId) as $indexMenu => $rowMenu ){
            $eachMenu[] = $rowMenu->menu_id;
        }
        return $eachMenu;
    }

}
