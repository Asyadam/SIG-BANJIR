<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',   
            'page' => 'v_dashboard',  
        ];

        return view('v_template', $data);
    }

    public function viewMap()
    {
        $data = [
            'judul' => 'View Map',   
            'page' => 'v_view_map',   
        ];

        return view('v_template', $data);
    }

    public function baseMap()
    {
        $data = [
            'judul' => 'Base Map',   
            'page' => 'v_base_map',   
        ];

        return view('v_template', $data);
    }

    public function marker()
    {
        $data = [
            'judul' => 'Marker',   
            'page' => 'v_marker',   
        ];

        return view('v_template', $data);
    }

    public function geojson()
    {
        $data = [
            'judul' => 'GeoJSON',   
            'page' => 'v_geojson',   
        ];

        return view('v_template', $data);
    }
}
