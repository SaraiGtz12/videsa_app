<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_usuario' => $this->id_usuario,
            'nombre_usuario' => $this->nombre_usuario,
            'nombre' => $this->nombre,
            'rfc' => $this->rfc,
            'correo' => $this->correo,
            'contrasena' => $this->contrasena,
            'id_rol' => $this->id_rol,
            'id_estatus' => $this->id_estatus

        ];
    }
}
