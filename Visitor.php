<?php

/**
 * Interface Role
 */
interface Role
{
    public function accept(RoleVisitorInterface $visitor);
}

/**
 * Class Users
 */
class Users implements Role
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return sprintf('User %s', $this->name);
    }

    public function accept(RoleVisitorInterface $visitor)
    {
        $visitor->visitUser($this);
    }
}

/**
 * Class Groups
 */
class Groups implements Role
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return sprintf('Group: %s', $this->name);
    }

    public function accept(RoleVisitorInterface $visitor)
    {
        $visitor->visitGroup($this);
    }
}

/**
 * Interface RoleVisitorInterface
 */
interface RoleVisitorInterface
{
    public function visitUser(Users $role);

    public function visitGroup(Groups $role);
}


/**
 * Class RoleVisitor
 */
class RoleVisitor implements RoleVisitorInterface
{
    private $visited = [];

    public function visitGroup(Groups $role)
    {
        $this->visited[] = $role;
    }

    public function visitUser(Users $role)
    {
        $this->visited[] = $role;
    }

    public function getVisited(): array
    {
        return $this->visited;
    }
}