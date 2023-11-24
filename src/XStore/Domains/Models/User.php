<?php

namespace XStore\Domains\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'USERS')]
class User extends BaseModel
{
    #[ORM\Id]
    #[ORM\Column(name: "ID", type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(name: "PASSWORD", type: 'string')]
    private string $password;

    public function __construct()
    {
        parent::__construct();
    }
}