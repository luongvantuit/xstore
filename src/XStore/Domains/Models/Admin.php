<?php

namespace XStore\Domains\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'admins')]
class Admin extends BaseModel
{
    #[ORM\Column(name: "identify", type: 'string', unique: true)]
    private string $identify;

    #[ORM\Column(name: "password", type: 'string')]
    private string $password;

    public function __construct(string $identify, string $password)
    {
        parent::__construct();
        $this->identify = $identify;
        $this->password = $password;
    }

    public function set_password(string $password): void
    {
        $this->password = $password;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_password(): string
    {
        return $this->password;
    }

    public function set_identify(string $identify): void
    {
        $this->identify = $identify;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_identify(): string
    {
        return $this->identify;
    }
}
