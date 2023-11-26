<?php

namespace XStore\Domains\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'USERS')]
class User extends BaseModel
{

    #[ORM\Column(name: "PASSWORD", type: 'string')]
    private string $password;

    public function __construct(string $password)
    {
        parent::__construct();
        $this->password = $password;
    }

    public function set_password(string $password): void
    {
        $this->password = $password;
    }

    public function get_password(): string
    {
        return $this->password;
    }
}
