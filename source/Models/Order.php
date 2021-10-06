<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Core\Connect;

class Order extends Model
{
    public function __construct()
    {
        parent::__construct("order");
    }
    
    /**
     * findById
     *
     * @param  mixed $id
     * @param  mixed $columns
     * @return Model
     */
    public function findById(int $id, string $columns = "*"): ?Model
    {
        $find = $this->find("order_id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    /**
     * getProduct
     *
     * @param  mixed $order_id
     * @return void
     */
    public function getProduct(int $order_id)
    {
        $query =  "SELECT * FROM `order_product` WHERE order_id = {$order_id}";
        $con = Connect::getInstance()->prepare($query);
        $con->execute();
        
        return $con->fetchAll(\PDO::FETCH_OBJ);
            
    }
    
    /**
     * getHistory
     *
     * @param  mixed $order_id
     * @return void
     */
    public function getHistory(int $order_id)
    {
        $query = "SELECT * FROM `order_history` WHERE order_id = {$order_id}";
        $con = Connect::getInstance()->prepare($query);
        $con->execute();

        return $con->fetchAll(\PDO::FETCH_OBJ);
    }
    
    /**
     * getShipment
     *
     * @param  mixed $order_id
     * @return void
     */
    public function getShipment(int $order_id)
    {
        $query = "SELECT * FROM `order_shipment` WHERE order_id = {$order_id}";
        $con = Connect::getInstance()->prepare($query);
        $con->execute();

        if($con->rowCount() > 1){
            
            return $con->fetchAll(\PDO::FETCH_OBJ);
            
        }
            return $con->fetch();
    }
    
    /**
     * getTotal
     *
     * @param  mixed $order_id
     * @return void
     */
    public function getTotal(int $order_id)
    {
        $query = "SELECT * FROM `order_total` WHERE order_id = {$order_id}";
        $con = Connect::getInstance()->prepare($query);
        $con->execute();
        return $con->fetchAll(\PDO::FETCH_OBJ);
    }
    
    /**
     * getBuy
     *
     * @param  mixed $order_id
     * @param  mixed $code
     * @return void
     */
    public function getBuy($order_id, $code =  'sub_total'){
    
        $query = "SELECT value FROM `order_total` WHERE order_id ={$order_id} AND code = '{$code}' ";
        $con = Connect::getInstance()->prepare($query);
        $con->execute();
        return $con->fetch();
    }
    
    /**
     * getStatus
     *
     * @param  mixed $order_status_id
     * @return void
     */
    public function getStatus(int $order_status_id)
    {
        $query = "SELECT * FROM `order_status` WHERE order_status_id = {$order_status_id}";
        $con = Connect::getInstance()->prepare($query);
        $con->execute();

        return $con->fetch(\PDO::FETCH_NUM);
    }

}