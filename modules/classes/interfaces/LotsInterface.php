<?php

interface LotsInterface
{
    public function newLot();

    public function changeLot($title, $price, $description, $lot_id);

    public function deleteLot($lot_id);

    public function showLot($id);

    public function showAllLots();
}
