<?php 

namespace App\Controllers;


use CodeIgniter\Controller;

class Pages extends Controller
{

    public function view($page = 'questionnement')
    {
        if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        
        echo view('header', $data);  
        echo view('pages/' . $page, $data);
        echo view('footer', $data);
    }
}