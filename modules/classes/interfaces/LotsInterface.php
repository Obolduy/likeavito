<?php

interface LotsInterface
{
    public function newLot(): void;

    public function changeLot(string $title, int $price, string $description, string $photo, int $lot_id);

    public function deleteLot(int $lot_id): void;

    public function showLot(int $id);

    public function showAllLots();
}
