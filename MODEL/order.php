<?php 
    Class Order
    {
        protected $conn;
        protected $table_name = "order0";

        protected $user_ID;
        protected $total_price;
        protected $date_hour_sale;
        protected $break_ID;
        protected $status_ID;
        protected $pickup_ID;
        protected $json;


        //chi deve calcolare il prezzo totale del carrello? quelli che fanno il carrello

        public function __construct($db)
        {
            $this->conn = $db;
        }

        function getArchiveOrder() // Ottiene tutti gli ordini
        {
            $query = "SELECT * FROM $this->table_name";

            $stmt = $this->conn->query($query);

            return $stmt;
        }

        function getOrder($id) // Ottiene l'ordine con l'id passato alla funzione
        {
            $query = "SELECT * FROM $this->table_name WHERE ID = $id";

            $stmt = $this->conn->query($query);

            return $stmt;
        }

        function getArchiveOrderStatus($id) // Ottiene gli ordini in base allo stato
        {
            $query = "SELECT * FROM $this->table_name WHERE status_ID = $id";

            $stmt = $this->conn->query($query);

            return $stmt;
        }

        function getArchiveOrderBreak($id) // Ottiene gli ordini in base alla ricreazione
        {
            $query = "SELECT * FROM $this->table_name WHERE break_ID = $id";

            $stmt = $this->conn->query($query);

            return $stmt;
        }

        function delete($id){ // Annulla un ordine

            $query = "UPDATE $this->table_name SET status_ID = 3 WHERE ID = $id";

            $stmt = $this->conn->query($query);

            return $stmt;
        }

        
        function setStatus($id){ // setta lo stato di un ordine a 2, pronto

            $query = "UPDATE $this->table_name SET status_ID = 2 WHERE ID = $id";

            $stmt = $this->conn->query($query);

            return $stmt;
        }


        /*
            Esempio body da passare alla funzione

            {
                "user_ID": 1,
                "total_price": 15.50,
                "break_ID": 1,
                "status_ID": 1,
                "pickup_ID": 1,
                "products": [
                        {"ID": 1, "quantity": 1},
                        {"ID": 2, "quantity": 1},
                        {"ID": 3, "quantity": 2}
                    ],
                "json": {
                "user_ID": 1,
                "total_price": 15.50,
                "break_ID": 1,
                "status_ID": 1,
                "pickup_ID": 1,
                "products": [
                        {"name": "panino al prosciutto", "price": 3, "quantity":1},
                        {"name": "panino al salame", "price": 3, "quantity":1},
                        {"name": "panino proteico", "price": 3, "quantity":2}
                    ]
                }
            }
        */

        function setOrder($user_ID, $total_price, $break_ID, $status_ID, $pickup_ID, $json){ // Crea un ordine di vetrina
            
            $query = "INSERT INTO $this->table_name (user_ID, total_price, break_ID, status_ID, pickup_ID, json)
                      VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('idiiis', $user_ID, $total_price, $break_ID, $status_ID, $pickup_ID, $json);
            if ($stmt->execute())
            {
                return $stmt;
            }
            else
            {
                return "";
            }
        }
    }
?>
