<?php

interface LotsInterface
{
    public function newLot(): void;

    public function changeLot(string $title, int $price, string $description, int $lot_id): void;

    public function deleteLot(int $lot_id): void;

    public function showLot(int $id): array;

    public function showAllLots(): array;
}
