<?php

namespace App\Http\Controllers;

use App\Mail\NewDoctor;
use App\Models\Doctors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DoctorsController extends Controller
{
    public function login(Request $req, Doctors $doctor)
    {
        $id = $doctor->login(
            $req->post('email'),
            $req->post('password')
        );

        if ($id) {
            return ['id' => $id];
        }

        return response(['error' => 'Doctor not found'], 404);
    }

    public function index(Doctors $doctors)
    {
        return $doctors->index();
    }

    public function create(Request $req, Doctors $doctors)
    {
        $id = $doctors->create($req->post());

        Mail::to('mahira@grupoplanmark.com.br')->send(new NewDoctor($req->post()));

        return ['id' => $id];
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Doctors $doctors)
    {
        //
    }

    public function edit(Doctors $doctors)
    {
        //
    }

    public function update(Request $request, Doctors $doctors)
    {
        //
    }

    public function destroy(Doctors $doctors)
    {
        //
    }
}
