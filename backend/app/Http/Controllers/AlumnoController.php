<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;


class AlumnoController extends Controller
{
    public function listar()
    {
        $alumnos = Alumno::orderBy('id', 'asc')->get();

        return $alumnos;
    }

    public function verificar(Request $request)
    {
        $resultado = 'NO_EXISTE';

        $id = $request->id;
        $dni = $request->dni;

        $alumno = Alumno::where('dni', $dni)->get()->last();

        if ($alumno != null) {

            if ($id == null) {
                $resultado = 'EXISTE';
            } else if ($alumno->id != $id) {
                $resultado = 'EXISTE';
            }
        }

        return [$resultado];
    }

    public function guardar(Request $request)
    {
        $frmDatosAlumno = $request->frmDatosAlumno;

        $alumno = new Alumno();

        $alumno->dni = $frmDatosAlumno['dni'];
        $alumno->apellido_paterno = mb_strtoupper(trim($frmDatosAlumno['apellido_paterno']));
        $alumno->apellido_materno = mb_strtoupper(trim($frmDatosAlumno['apellido_materno']));
        $alumno->nombres = mb_strtoupper(trim($frmDatosAlumno['nombres']));
        $alumno->edad = $frmDatosAlumno['edad'];
        $alumno->genero = $frmDatosAlumno['genero'];
        $alumno->estado_matricula = $frmDatosAlumno['estado_matricula'];
        $alumno->email = $frmDatosAlumno['email'];

        $alumno->save();

        return [$alumno];
    }

    public function actualizar($id, Request $request)
    {
        $frmDatosAlumno = $request->frmDatosAlumno;

        $alumno = Alumno::find($id);

        $alumno->dni =  $frmDatosAlumno['dni'];
        $alumno->apellido_paterno = mb_strtoupper(trim($frmDatosAlumno['apellido_paterno']));
        $alumno->apellido_materno = mb_strtoupper(trim($frmDatosAlumno['apellido_materno']));
        $alumno->nombres = mb_strtoupper(trim($frmDatosAlumno['nombres']));
        $alumno->edad =  $frmDatosAlumno['edad'];
        $alumno->genero = $frmDatosAlumno['genero'];
        $alumno->estado_matricula = $frmDatosAlumno['estado_matricula'];
        $alumno->email = $frmDatosAlumno['email'];

        $alumno->save();

        return [$alumno];
    }

    public function eliminar($id)
    {
        $alumno = Alumno::find($id);
        $alumno->delete();

        return [$id];
    }
}
