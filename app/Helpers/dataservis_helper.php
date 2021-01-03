<?php

use App\Models\ServisModel;

function search_servis(string $field, $keyword, string $status)
{
    $servis = new ServisModel();
    $data =  $servis->where('status_servis', $status)
        ->like($field, $keyword)
        ->orderBy('tgl_masuk', 'DESC')
        ->findAll();
    return $data;
}
