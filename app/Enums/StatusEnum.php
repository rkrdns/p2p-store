<?php

namespace App\Enums;

enum StatusEnum:string
{
    case CREATED = 'Pendiente';
    case PAYED = 'Pagado';
    case REJECTED = 'Cancelado/Rechazado';
    case APPROVED = 'Aprobado';
    case EXPIRED = 'Sesión expirada';
}
?>