<?php
  
namespace App\Enums;
 
enum UserRoleEnum :string 
{
    case Eleve = 'eleve';
    case Prof = 'prof';
    case Admin = 'admin';

}
