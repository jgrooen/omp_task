<?php

namespace App\Models\Entities;

use Eghamat24\DatabaseRepository\Models\Entity\Entity;

class PaymentChannel extends Entity
{
    protected int $id;

	protected string $name;

	protected null|string $nameEn = null;

	protected string $className;

	protected null|string $url = null;

	protected bool $isActive = false;

	protected null|int $priority = null;

	protected null|string $supporterName = null;

	protected null|string $supporterPhone = null;

	protected null|string $supporterEmail = null;

	protected null|string $description = null;

	protected null|string $createdAt = null;

	protected null|string $updatedAt = null;

	public function getId(): int
    {
        return $this->id;
    }

	public function setId(int $id): void
    {
        $this->id = $id;
    }

	public function getName(): string
    {
        return $this->name;
    }

	public function setName(string $name): void
    {
        $this->name = $name;
    }

	public function getNameEn(): null|string
    {
        return $this->nameEn;
    }

	public function setNameEn(null|string $nameEn): void
    {
        $this->nameEn = $nameEn;
    }

	public function getClassName(): string
    {
        return $this->className;
    }

	public function setClassName(string $className): void
    {
        $this->className = $className;
    }

	public function getUrl(): null|string
    {
        return $this->url;
    }

	public function setUrl(null|string $url): void
    {
        $this->url = $url;
    }

	public function getIsActive(): bool
    {
        return $this->isActive;
    }

	public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

	public function getPriority(): null|int
    {
        return $this->priority;
    }

	public function setPriority(null|int $priority): void
    {
        $this->priority = $priority;
    }

	public function getSupporterName(): null|string
    {
        return $this->supporterName;
    }

	public function setSupporterName(null|string $supporterName): void
    {
        $this->supporterName = $supporterName;
    }

	public function getSupporterPhone(): null|string
    {
        return $this->supporterPhone;
    }

	public function setSupporterPhone(null|string $supporterPhone): void
    {
        $this->supporterPhone = $supporterPhone;
    }

	public function getSupporterEmail(): null|string
    {
        return $this->supporterEmail;
    }

	public function setSupporterEmail(null|string $supporterEmail): void
    {
        $this->supporterEmail = $supporterEmail;
    }

	public function getDescription(): null|string
    {
        return $this->description;
    }

	public function setDescription(null|string $description): void
    {
        $this->description = $description;
    }

	public function getCreatedAt(): null|string
    {
        return $this->createdAt;
    }

	public function setCreatedAt(null|string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

	public function getUpdatedAt(): null|string
    {
        return $this->updatedAt;
    }

	public function setUpdatedAt(null|string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
