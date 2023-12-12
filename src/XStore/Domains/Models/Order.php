<?php

namespace XStore\Domains\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'orders')]

class Order extends BaseModel
{
    

        #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "orders")]
        #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", onDelete: "CASCADE")]
        private User $user;

        #[ORM\ManyToOne(targetEntity: Address::class, inversedBy: "orders")]
        #[ORM\JoinColumn(name: "address_id", referencedColumnName: "id", onDelete: "CASCADE")]
        private Address $address;
    
    
        #[ORM\Column(name: "type_shipping_fee", type: 'integer')]
        private int $type_shipping_fee;

        #[ORM\Column(name: "status", type: 'string')]
        private string $status;
    
        public function __construct(User $user, Address $address, int $type_shipping_fee, string $status)
        {
            parent::__construct();
            $this->user = $user;
            $this->address = $address;
            $this->type_shipping_fee = $type_shipping_fee;
            $this->status = $status;
        }
        
        public function set_user(User $user): void
        {
            $this->user = $user;
        }

        public function get_user(): User
        {
            return $this->user;
        }

        public function set_address(Address $address): void
        {
            $this->address = $address;
        }

        public function get_address(): Address
        {
            return $this->address;
        }

        public function set_type_shipping_fee(int $type_shipping_fee): void
        {
            $this->type_shipping_fee = $type_shipping_fee;
        }

        public function get_type_shipping_fee(): int
        {
            return $this->type_shipping_fee;
        }

        public function set_status(string $status): void
        {
            $this->status = $status;
        }

        public function get_status(): string
        {
            return $this->status;
        }


}