<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PresdirFilter implements FilterInterface
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
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        if(session()->kode_jabatan == '0'){
            return redirect()->to('/home/index');
        }
    }
}