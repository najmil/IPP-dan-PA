<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        // if(session()->username){
        //     return redirect()->back();
        // }
        if(session()->kode_jabatan == ''){
            return redirect()->to('login/index');
        }
        
        $contentDept = $request->getGet('contentdept');
        $allowedDepartments = ['ehs', 'mtc', 'mkt', 'fincont', 'mis', 'hr', 'procurement', 'productsatu', 'productdua', 'ppic', 'spv', 'producteng', 'processeng', 'isd', 'qa'];

        if (!in_array($contentDept, $allowedDepartments)) {
            return redirect()->to('/forbidden');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        if(session()->kode_jabatan === '0' && session()->npk === '0'){
            return redirect()->to('/home/index');
        }
    }
}