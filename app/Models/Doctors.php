<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Doctors extends Model
{
    use HasFactory;

    public function index() {
        $query = "SELECT * FROM doctors";

        return \DB::select($query);
    }

    public function login($email, $password) {
        $results = \DB::select(
            "SELECT d.id
            FROM doctors as d
            WHERE d.email = ?
            AND d.password = ?",
            [$email, md5($password)]
        );

        if ($results) {
            return $results[0]->id;
        }

        return false;
    }

    public function create($data) {

        $query = "INSERT INTO doctors
                    (name, email, password, phone, crm, specialty, region, acceptance)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        if(DB::insert($query, [
            $data['name'],
            $data['email'],
            md5($data['password']),
            $data['phone'],
            $data['crm'],
            $data['specialty'],
            $data['region'],
            $data['acceptance'],
        ])) {
            $doctorId = DB::getPdo()->lastInsertId();

            if ($this->createConflicts($doctorId, $data['conflicts'])) {
                return $doctorId;
            }
        }
    }

    public function createConflicts($doctorId, $conflicts) {
        $query = "INSERT INTO doctors_conflicts
(doctor_id, laboratory, activity)
VALUES (?, ?, ?);";

        foreach ($conflicts as $conflict) {
            foreach ($conflict['activities'] as $activity) {
                DB::insert($query, [
                    $doctorId,
                    $conflict['laboratory'],
                    $activity,
                ]);
            }
        }

        return true;
    }
}
